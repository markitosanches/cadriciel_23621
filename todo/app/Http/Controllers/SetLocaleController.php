<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    public function index($locale){
        session()->put('locale', $locale);
        return back();
    }
}
