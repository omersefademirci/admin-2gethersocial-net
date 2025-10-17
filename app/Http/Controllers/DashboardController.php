<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Group;
use Illuminate\Support\Facades\Lang;

class DashboardController extends Controller
{
    public function brandDashboard($id)
    {
        if (!intval($id)) {
            abort(404);
        }

        // Brand ve Group Verileri

        $user = auth()->user(); // Giriş yapan kullanıcı

        if ($user->user_type === 'brand') {
            // Kullanıcı yalnızca kendisine bağlı markaları görebilir
            $brand = Brand::whereHas('restrictions', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->find($id);

            if (!$brand) {
                abort(403, 'Bu markayı görüntüleme yetkiniz yok.');
            }
        } else {
            // Diğer kullanıcılar tüm markaları görebilir
            $brand = Brand::find($id);
        }

        if (!$brand) {
            abort(404);
        }

        $group = Group::whereBrandId($brand->id)->latest()->first();
        $campaigns = Campaign::where(['group_id' => $group->id])->get();

        // Kampanya bazlı veriler (tıklama, izlenme, indirme, satış)
        $activePlatformMetrics = $this->getPlatformMetrics($campaigns);

        // Pasif platformlar
        $passivePlatforms = $this->getPassivePlatforms($activePlatformMetrics);

        // Aktif ve pasif platformları birleştir
        $platformMetrics = array_merge($activePlatformMetrics, $passivePlatforms);

        // En yüksek dönüşüm elde edilen kampanya
        $highestConversionCampaign = $this->getHighestConversionCampaign($campaigns);

        // Toplam planlanan ve harcanan bütçe, tıklama, izlenme, satış
        $totals = $this->getCampaignTotals($campaigns);

        // Tüketim oranı
        $consumptionRate = $this->getConsumptionRate($totals['planned'], $totals['spent']);

        // Mecra bazlı bütçe dağılımı
        $budgetDistribution = $this->getBudgetDistribution($campaigns);

        // Kampanya tipi dağılımı
        $campaignTypeDistribution = $this->getCampaignTypeDistribution($campaigns);

        // Kampanya bazlı bütçe dağılımı
        $campaignBudgetDistribution = $this->getCampaignBudgetDistribution($campaigns);

        // Kampanya listesi ve toplamları
        $campaignList = $this->getCampaignListWithTotals($campaigns);

        return view('pages.brand-dashboard', compact(
            'brand', 'group', 'platformMetrics', 'highestConversionCampaign', 'totals', 'consumptionRate',
            'budgetDistribution', 'campaignTypeDistribution', 'campaignBudgetDistribution', 'campaignList'
        ));
    }

    private function metricNamesTr($metricKey)
    {
        // Anahtar kelimeyi küçük harfe çevir ve dil dosyasındaki karşılığını getir
        return Lang::get('custom.metric.' . strtolower($metricKey));
    }

    private function getPlatformMetrics($campaigns)
    {
        $metrics = [];

        // Toplam tıklama, görüntüleme, indirme, satış verilerini topla
        $totalMetrics = [
            'clicks' => 0,
            'views' => 0,
            'downloads' => 0,
            'impressions' => 0,
            'sales' => 0,
        ];

        foreach ($campaigns as $campaign) {
            foreach (['clicks', 'views', 'impressions', 'downloads', 'sales'] as $metric) {
                if ($campaign->$metric > 0) {
                    $platform = $campaign->platform;
                    $metrics[] = [
                        'platform' => $platform,
                        'metric_name' => $this->metricNamesTr($metric),
                        'metric_key' => strtolower($metric),
                        'metric_value' => $campaign->$metric,
                        'status' => $campaign->status,
                    ];

                    $totalMetrics[$metric] += $campaign->$metric;
                }
            }
        }

        // Yüzdelik oranları hesapla
        foreach ($metrics as &$metric) {
            $metricType = $metric['metric_key'];
            $metric['metric_percentage'] = round(($metric['metric_value'] / $totalMetrics[$metricType]) * 100, 2);
        }

        return $metrics;
    }


    private function getPassivePlatforms($platformMetrics)
    {
        if (count($platformMetrics) >= 5) {
            return [];
        }

        $allPlatforms = ['Instagram', 'Facebook', 'TikTok', 'YouTube', 'Telegram', 'Discord', 'Pinterest', 'X'];

        // Aktif platformları çıkaralım
        $activePlatforms = array_map(function ($metric) {
            return $metric['platform'];
        }, $platformMetrics);

        // Pasif platformları bulalım
        $passivePlatforms = array_diff($allPlatforms, $activePlatforms);

        // Eksik olan platform sayısını hesapla
        $neededCount = 5 - count($platformMetrics);

        // Pasif platformlar için veriyi oluştur (eksik olan sayıda)
        $passiveMetrics = [];
        foreach (array_slice($passivePlatforms, 0, $neededCount) as $platform) {
            $passiveMetrics[] = [
                'platform' => $platform,
                'metric_name' => __('custom.metric.clicks'),
                'metric_key' => 'clicks',
                'metric_value' => 0,
                'metric_percentage' => 0,
                'status' => 'Pasif',
            ];
        }

        return $passiveMetrics;
    }


    private function getHighestConversionCampaign($campaigns)
    {
        $maxConversion = 0;
        $highestCampaign = null;
        $highestMetricName = '';

        foreach ($campaigns as $campaign) {
            $metrics = [
                'clicks' => $campaign->clicks,
                'views' => $campaign->views,
                'downloads' => $campaign->downloads,
                'sales' => $campaign->sales,
            ];

            foreach ($metrics as $metricName => $value) {
                if ($value > $maxConversion) {
                    $maxConversion = $value;
                    $highestCampaign = $campaign;
                    $highestMetricName = $this->metricNamesTr($metricName);
                }
            }
        }

        return [
            'campaign' => $highestCampaign,
            'highest_value' => $maxConversion,
            'highest_metric_name' => $highestMetricName
        ];
    }

    private function getCampaignTotals($campaigns)
    {
        $totals = [
            'planned' => 0,
            'spent' => 0,
            'clicks' => 0,
            'views' => 0,
            'impressions' => 0,
            'downloads' => 0,
            'sales' => 0,
            'remaining' => 0
        ];

        foreach ($campaigns as $campaign) {
            $totals['planned'] += $campaign->planned;
            $totals['spent'] += $campaign->spent;
            $totals['remaining'] += $campaign->planned - $campaign->spent;
            $totals['clicks'] += $campaign->clicks;
            $totals['views'] += $campaign->views;
            $totals['impressions'] += $campaign->impressions;
            $totals['downloads'] += $campaign->downloads;
            $totals['sales'] += $campaign->sales;
        }

        return $totals;
    }

    private function getConsumptionRate($planned, $spent)
    {
        if ($planned == 0) return 0;
        return round(($spent / $planned) * 100, 2);
    }

    private function getBudgetDistribution($campaigns)
    {
        $distribution = [];

        foreach ($campaigns as $campaign) {
            $platform = $campaign->platform;

            if (!isset($distribution[$platform])) {
                $distribution[$platform] = 0;
            }

            $distribution[$platform] += $campaign->spent;
        }

        $totalSpent = array_sum($distribution);

        foreach ($distribution as $platform => $spent) {
            $distribution[$platform] = [
                'spent' => $spent,
                'percentage' => round(($spent / $totalSpent) * 100, 2),
            ];
        }

        return $distribution;
    }

    private function getCampaignTypeDistribution($campaigns)
    {
        $distribution = [];

        foreach ($campaigns as $campaign) {
            $type = $campaign->campaign_type;

            if (!isset($distribution[$type])) {
                $distribution[$type] = 0;
            }

            $distribution[$type] += 1;
        }

        $totalCampaigns = array_sum($distribution);

        foreach ($distribution as $type => $count) {
            $distribution[$type] = [
                'count' => $count,
                'percentage' => round(($count / $totalCampaigns) * 100, 2),
            ];
        }

        return $distribution;
    }

    private function getCampaignBudgetDistribution($campaigns)
    {
        $distribution = [];

        foreach ($campaigns as $campaign) {
            $distribution[] = [
                'campaign_name' => $campaign->campaign_name,
                'planned' => $campaign->planned,
                'spent' => $campaign->spent,
            ];
        }

        return $distribution;
    }

    private function getCampaignListWithTotals($campaigns)
    {
        $campaignList = [];
        $totals = [
            'planned' => 0,
            'spent' => 0,
            'unit_price' => 0,
            'unit_percentage' => 0,
            'clicks' => 0,
            'views' => 0,
            'downloads' => 0,
            'sales' => 0,
            'impressions' => 0,
        ];

        $campaignCounter = count($campaigns);

        foreach ($campaigns as $campaign) {
            $campaignList[] = $campaign;

            $totals['planned'] += $campaign->planned;
            $totals['spent'] += $campaign->spent;
            $totals['unit_price'] += $campaign->unit_price;
            $totals['unit_percentage'] += $campaign->unit_percentage;
            $totals['clicks'] += $campaign->clicks;
            $totals['views'] += $campaign->views;
            $totals['downloads'] += $campaign->downloads;
            $totals['sales'] += $campaign->sales;
            $totals['impressions'] += $campaign->impressions;
        }

        $totals['unit_price'] /= $campaignCounter;
        $totals['unit_percentage'] /= $campaignCounter;

        return compact('campaignList', 'totals');
    }

}
