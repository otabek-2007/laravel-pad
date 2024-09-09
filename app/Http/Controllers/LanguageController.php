<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $lang = $request->input('lang');

        // Set the locale for the application
        app()->setLocale($lang);

        // Store the selected language in the session
        Session::put('locale', $lang);

        // Redirect back to the previous page
        return redirect()->back();
    }
}
