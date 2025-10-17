<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Group;
use App\Models\Campaign;
use Maatwebsite\Excel\Facades\Excel;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'brandSelect' => 'required|exists:brands,id',
            'campaignFile' => 'required|file|mimes:xlsx',
            'note' => 'nullable|string',
        ]);

        // Seçilen marka ID'si
        $brand_id = $request->input('brandSelect');
        $note = $request->input('note');

        // Group oluşturma
        $group = Group::create([
            'brand_id' => $brand_id,
            'notes' => $note,
        ]);

        // Excel dosyasını işleme
        $data = Excel::toArray([], $request->file('campaignFile'));

        foreach ($data[0] as $key => $row) {
            if ($key === 0) {
                continue;
            }

            if($row[0] == null) {
                break;
            }

           // echo number_format((float) $this->filterNum($row[12]), 2, '.', '')."\n";

            $rawData = [
                'campaign_id' => $row[0],
                'campaign_name' => $row[1],
                'brand' => $row[2],
                'start_date' => Date::excelToDateTimeObject($row[3])->format('Y-m-d'),
                'end_date' => Date::excelToDateTimeObject($row[4])->format('Y-m-d'),
                'network_category' => $row[5],
                'ad_model' => $row[6],
                'platform' => $row[7],
                'campaign_type' => $row[8],
                'planned' => $this->filterNum($row[9]),
                'spent' => $this->filterNum($row[10]),
                'unit_price' => $this->filterNum($row[11]),
                'unit_percentage' => $this->filterNum($row[12]),
                'clicks' => $this->filterNum($row[13]),
                'sales' => $this->filterNum($row[14]),
                'impressions' => $this->filterNum($row[15]),
                'downloads' => $this->filterNum($row[16]),
                'views' => $this->filterNum($row[17]),
                'currency' => $this->detectCurrency($row[10]),
                'status' => $row[18],
                'brand_id' => $brand_id,
                'group_id' => $group->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            //print_r($rawData);
            //echo "\n-----\n";
            Campaign::create($rawData);
        }

        return response()->json(['message' => 'Veriler başarıyla eklendi!']);
    }

    private function detectCurrency($value)
    {
        if (strpos($value, '₺') !== false) {
            return 'TRY';
        } elseif (strpos($value, '$') !== false) {
            return 'USD';
        } elseif (strpos($value, '€') !== false) {
            return 'EUR';
        }
        return null;
    }

    // iptal direkt giriş
    private function filterPercentage($value)
    {
        // TODO: 100 ile çarpıldığında 100 üzeri hata verilmeli

        return (float) $this->filterNum($value) * 100;
    }

    private function filterNum($value)
    {
        // Sadece sayıları ve nokta, virgül karakterlerini tut
        $cleanedValue = preg_replace('/[^0-9.,]/', '', $value);

        // Eğer değer virgül içeriyorsa, virgülü noktaya çevir (decimal ayırıcı olarak kullanmak için)
        if (strpos($cleanedValue, ',') !== false) {
            $cleanedValue = str_replace(',', '.', $cleanedValue);
        }

        // Sonuç olarak sayıyı döndür (decimal olarak)
        return is_numeric($cleanedValue) ? $cleanedValue : 0;
    }

}
