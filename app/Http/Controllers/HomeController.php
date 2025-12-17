<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = User::where('role', 'doctor')->get();

        return view('pages.home', compact('doctors'));
    }
}
