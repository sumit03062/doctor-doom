<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Appointment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 👨‍⚕️ Doctor dashboard
        if ($user->role === 'doctor') {
            $appointments = Appointment::where('doctor_id', $user->id)
                ->where('status', 'upcoming')
                ->latest()
                ->get();

            return view('doctor.dashboard', compact('appointments'));
        }

        // 👤 Patient dashboard
        $query = Appointment::where('user_id', $user->id);

        // Prevent crash if column doesn't exist
        if (Schema::hasColumn('appointments', 'payment_status')) {
            $query->where('payment_status', 'paid');
        }

        $appointments = $query->latest()->get();

        return view('dashboard', compact('appointments'));
    }
}
