<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class AppointmentController extends Controller
{
    /**
     * Show appointment creation form
     */
    public function create()
    {
        $doctors = User::where('role', 'doctor')->get();
        return view('appointment.create', compact('doctors'));
    }

    /**
     * Store appointment
     */
    public function store(Request $request, GoogleCalendarService $calendar)
    {
        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'doctor_id'        => 'nullable|exists:users,id',
            'email'            => 'required|email',
            'phone'            => 'required|string|max:20',
            'age'              => 'nullable|integer|min:1|max:120',
            'gender'           => 'nullable|string',
            'department'       => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'message'          => 'nullable|string',
        ]);



        try {
            // Prevent double booking
            if ($request->doctor_id) {
                $alreadyBooked = Appointment::where('doctor_id', $request->doctor_id)
                    ->where('appointment_date', $request->appointment_date)
                    ->where('appointment_time', $request->appointment_time)
                    ->where('status', '!=', 'canceled')
                    ->exists();

                if ($alreadyBooked) {
                    return back()->withErrors([
                        'appointment_time' => 'This doctor is already booked for the selected date and time.'
                    ])->withInput();
                }
            }

            // Create appointment
            $appointment = Appointment::create([
                'user_id'          => Auth::id(),
                'doctor_id'        => $request->doctor_id,
                'full_name'        => $request->full_name,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'age'              => $request->age,
                'gender'           => $request->gender,
                'department'       => $request->department,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'message'          => $request->message,
                'status'           => 'upcoming',
            ]);

            // Email confirmation
            Mail::to($appointment->email)
                ->send(new AppointmentConfirmation($appointment));

            // Google Calendar
            $start = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);
            $end   = $start->copy()->addMinutes(30);

            $calendar->createEvent([
                'full_name' => $request->full_name,
                'message'   => $request->message,
                'start'     => $start->toRfc3339String(),
                'end'       => $end->toRfc3339String(),
            ]);



            return redirect()->route('appointment.confirmation', $appointment);
        } catch (\Exception $e) {


            return back()->withErrors([
                'error' => 'Something went wrong. Please try again.'
            ])->withInput();
        }
    }


    /**
     * Cancel appointment
     */
    public function cancel(Appointment $appointment)
    {
        $user = Auth::user();
        $cancelBy = $user->id === $appointment->user_id ? 'patient' : ($user->role === 'doctor' ? 'doctor' : 'admin');

        $appointment->update([
            'status'      => 'canceled',
            'canceled_by' => $cancelBy,
        ]);

        return back()->with('success', 'Appointment canceled successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Appointment $appointment)
    {
        $doctors = User::where('role', 'doctor')->get();

        return view('appointment.edit', compact('appointment', 'doctors'));
    }


    /**
     * Update appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'doctor_id'        => 'nullable|exists:users,id',
            'email'            => 'required|email',
            'phone'            => 'required|string|max:20',
            'age'              => 'nullable|integer|min:1|max:120',
            'gender'           => 'nullable|string',
            'department'       => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'message'          => 'nullable|string',
            'status'           => 'nullable|in:upcoming,completed,canceled',
        ]);



        try {
            // Prevent double booking if doctor changed
            if ($request->doctor_id) {
                $alreadyBooked = Appointment::where('doctor_id', $request->doctor_id)
                    ->where('appointment_date', $request->appointment_date)
                    ->where('appointment_time', $request->appointment_time)
                    ->where('status', '!=', 'canceled')
                    ->where('id', '!=', $appointment->id)
                    ->exists();

                if ($alreadyBooked) {
                    throw ValidationException::withMessages([
                        'appointment_time' => 'This doctor is already booked for the selected date and time. Please choose another slot.'
                    ]);
                }
            }

            $appointment->update($validated);


            return redirect()->route('appointment.edit', $appointment)
                ->with('success', 'Appointment updated successfully.');
        } catch (\Exception $e) {

            return back()->withErrors([
                'error' => 'Something went wrong. Please try again.'
            ])->withInput();
        }
    }
}
