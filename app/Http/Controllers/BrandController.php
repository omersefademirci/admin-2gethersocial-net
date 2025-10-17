<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'companyLogo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'companyName' => 'required|string|max:255',
        ]);

        $logoPathName = '';
        if($request->hasFile('companyLogo')) {
            $logoFile = $request->file('companyLogo');
            $logoPathName = time() . '_' . $logoFile->getClientOriginalName();
            $logoFile->storeAs('public/logos', $logoPathName);
        }

        $brand = Brand::create([
            'name' => $request->input('companyName'),
            'logo' => $logoPathName,
        ]);

        return response()->json(['message' => 'Marka başarıyla eklendi!', 'brand' => $brand]);
    }

    public function destroy($id)
    {
        $brand = Brand::with('groups.campaigns')->find($id);

        if (!$brand) {
            return response()->json(['error' => 'Marka bulunamadı!'], 404);
        }

        // İlgili kampanyaları ve grupları sil
        foreach ($brand->groups as $group) {
            foreach ($group->campaigns as $campaign) {
                $campaign->delete();
            }
            $group->delete();
        }

        // Markaya ait logoyu sil
        if (Storage::exists('public/logos/' . $brand->logo)) {
            Storage::delete('public/logos/' . $brand->logo);
        }

        // Markayı sil
        $brand->delete();

        return response()->json(['message' => 'Marka ve ilgili veriler başarıyla silindi!']);
    }
    
    public function jsonBrands()
    {
        $user = auth()->user(); // Giriş yapan kullanıcı

        if ($user->user_type === 'brand') {
            // Kullanıcı yalnızca kendisine bağlı markaları görür
            $brands = Brand::whereHas('restrictions', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['groups.campaigns'])->get();
        } else {
            // Diğer kullanıcılar tüm markaları görür
            $brands = Brand::with(['groups.campaigns'])->get();
        }

        $brandData = $brands->map(function ($brand) {
            $latestGroup = $brand->groups->sortByDesc('created_at')->first();

            $brandLogoFullPath = $brand->logo
                ? asset('storage/logos/' . $brand->logo)
                : asset('assets/images/customs/default-brand-logo.png');

            if (!$latestGroup) {
                return [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'logo' => $brandLogoFullPath,
                    'total_planned' => 0,
                    'total_spent' => 0,
                    'total_groups' => 0,
                    'best_performance' => 0,
                ];
            }

            $totalPlanned = $latestGroup->campaigns->sum('planned');
            $totalSpent = $latestGroup->campaigns->sum('spent');
            $totalGroups = $brand->groups->count();
            $bestPerformance = $latestGroup->campaigns->max('performance_percentage');

            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'logo' => $brandLogoFullPath,
                'total_planned' => $totalPlanned,
                'total_spent' => $totalSpent,
                'total_groups' => $totalGroups,
                'best_performance' => $bestPerformance
            ];
        });

        return response()->json($brandData);
    }

    public function index()
    {
        $user = auth()->user(); // Giriş yapan kullanıcı
    
        if ($user->user_type === 'brand') {
            // Kullanıcı yalnızca kendisine bağlı markaları görür
            $brands = Brand::whereHas('restrictions', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } else {
            // Diğer kullanıcılar tüm markaları görür
            $brands = Brand::all();
        }
    
        return response()->json($brands);
    }
}
