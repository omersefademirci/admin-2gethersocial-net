<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrandUserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtmController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

// Kimlik doğrulama gerektiren rotalar
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        // Session'daki dili al, yoksa varsayılan dili kullan
        $locale = Session::get('locale', config('app.locale'));
        Lang::setLocale($locale);

        return view('pages.brands');
    });

    Route::get('/dashboard', function () {
        // Session'daki dili al, yoksa varsayılan dili kullan
        $locale = Session::get('locale', config('app.locale'));
        Lang::setLocale($locale);

        return view('pages.brands');
    })->name('dashboard');

    // Dashboard id'ye göre gösterme rotası
    Route::get('/dashboard/{id}', function ($id) {
        // Session'daki dili al, yoksa varsayılan dili kullan
        $locale = Session::get('locale', config('app.locale'));
        Lang::setLocale($locale);

        // DashboardController'dan işlemleri al
        return app(DashboardController::class)->brandDashboard($id);
    })->name('brand_dashboard');
    // Marka ekleme ve listeleme için rotalar
    Route::post('/brands', [BrandController::class, 'store'])->name('store_brand');
    Route::get('/json-brands', [BrandController::class, 'jsonBrands'])->name('json_brands');
    Route::patch('/brands/{brand}/currency', [BrandController::class, 'updateCurrency'])->name('brands.update_currency');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('destroy_brand');
    Route::get('/brand-users', [BrandUserController::class, 'index'])->name('brand_users.index');
    Route::post('/brand-users', [BrandUserController::class, 'store'])->name('brand_users.store');
    Route::post('/brand-users/assign', [BrandUserController::class, 'assign'])->name('brand_users.assign');
    Route::get('/brand-members', [BrandUserController::class, 'allMembers'])->name('brand_users.all');
    Route::delete('/brand-users/{user}', [BrandUserController::class, 'destroyUser'])->name('brand_users.delete');
    Route::get('/brands/{brand}/members', [BrandUserController::class, 'members'])->name('brand_users.members');
    Route::delete('/brands/{brand}/members/{user}', [BrandUserController::class, 'destroy'])->name('brand_users.destroy');
    // Veri ekleme için rota
    Route::post('/import-campaigns', [CampaignController::class, 'store'])->name('import_campaigns');

    // Profil düzenleme, güncelleme ve silme rotaları
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard id'ye göre gösterme rotası
    Route::get('/utm', function () {
        // Session'daki dili al, yoksa varsayılan dili kullan
        $locale = Session::get('locale', config('app.locale'));
        Lang::setLocale($locale);

        // DashboardController'dan işlemleri al
        return app(UtmController::class)->utmCreator();
    })->name('utm.creator');

    Route::post('/utm/store', [UtmController::class, 'utmStore'])->name('store_utm');
    Route::post('/utm/store/custom', [UtmController::class, 'customUtmStore'])->name('store_utm_custom');
});
Route::get('change-language/{locale}', function ($locale) {
    // Desteklenen diller
    $availableLanguages = ['en', 'tr'];

    if (in_array($locale, $availableLanguages)) {
        // Dil ayarını yap
        Lang::setLocale($locale);

        // Dili session'a kaydet
        Session::put('locale', $locale);
    }

    // Geriye yönlendir
    return redirect()->back();
})->name('change-language');

// Breeze tarafından sağlanan auth rotalarını dahil edin
require __DIR__ . '/auth.php';

/*
* Urls to run artisan commands on shared servers
* */
Route::group(['prefix' => 'artisan'], function () {
    Route::get('/clear-cache', function () {
        $exitCode = Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    });

    //Reoptimized class loader:
    Route::get('/optimize', function () {
        $exitCode = Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    });

    //Route cache:
    Route::get('/route-cache', function () {
        $exitCode = Artisan::call('route:cache');
        return '<h1>Routes cached</h1>';
    });

    //Clear Route cache:
    Route::get('/route-clear', function () {
        $exitCode = Artisan::call('route:clear');
        return '<h1>Route cache cleared</h1>';
    });

    //Clear View cache:
    Route::get('/view-clear', function () {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/config-cache', function () {
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/config-clear', function () {
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/storage-link', function () {
        $exitCode = Artisan::call('storage:link');
        return '<h1>Storage link created</h1>';
    });
});
