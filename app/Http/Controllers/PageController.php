<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about'); // points to resources/views/pages/about.blade.php
    }

     public function service()
    {
        return view('pages.service');
    }
}
