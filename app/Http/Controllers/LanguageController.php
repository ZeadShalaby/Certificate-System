<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //
    public function change($lang)
    {
        Session::put('lang', $lang);
        App::setLocale($lang);
        return back();
    }
}
