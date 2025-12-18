<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 👨‍⚕️ Doctor dashboard → only his appointments
        if ($user->role === 'doctor') {
            $appointments = Appointment::where('doctor_id', $user->id)
                ->latest()
                ->get();

            return view('doctor.dashboard', compact('appointments'));
        }

        // 👤 Patient dashboard → only his appointments
        $appointments = Appointment::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard', compact('appointments'));

        $doctors = User::where('role', 'doctor')->get();

        return view('home', compact('doctors'));
    }
}
