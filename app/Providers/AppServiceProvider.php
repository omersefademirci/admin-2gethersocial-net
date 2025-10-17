<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function() {
            return base_path('public_html');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Varsayılan para birimi ayarı
        setlocale(LC_MONETARY, "tr_TR");
        Carbon::setLocale("tr_TR");

        // Kullanıcının seçtiği dil ayarını session'dan al ve uygulamaya uygula
        $locale = Session::get('locale', config('app.locale')); // Varsayılan olarak config/app.php'deki dil kullanılacak
        App::setLocale($locale);
    }
}
