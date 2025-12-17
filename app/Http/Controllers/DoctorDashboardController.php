<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Appointment; // make sure this exists

class DoctorDashboardController extends Controller
{
    public function dashboard()
    {
        $doctor = Auth::user();

        // Get appointments for this doctor
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('doctor.dashboard', compact('doctor', 'appointments'));
    }
}
