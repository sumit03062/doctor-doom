<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor; // make sure to import your Doctor model

class DoctorController extends Controller
{
    // Doctors page
    public function doctorsPage()
    {
        $doctors = Doctor::all(); // fetch all doctors
        return view('pages.doctors', compact('doctors'));
    }
}
