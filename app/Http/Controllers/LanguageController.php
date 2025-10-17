<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        $availableLanguages = ['en', 'tr'];
    
        if (!in_array($locale, $availableLanguages)) {
            $locale = config('app.fallback_locale');  // Geçerli bir dil değilse fallback'e dön
        }
    
        // Session'a dili kaydet
        Session::put('locale', $locale);
    
        // Geriye yönlendir
        return Redirect::back();
    }
}
