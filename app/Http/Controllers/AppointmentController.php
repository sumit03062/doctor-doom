<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class AppointmentController extends Controller
{
    public function create()
    {
        $doctors = User::where('role', 'doctor')->get(); // fetch all doctors
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request, GoogleCalendarService $calendar)
    {
        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'doctor_id' => 'nullable|exists:users,id',
            'email'            => 'required|email',
            'phone'            => 'required|string|max:20',
            'age'              => 'nullable|integer|min:1|max:120',
            'gender'           => 'nullable|string',
            'department'       => 'required|string',
            'doctor_id'        => 'nullable|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'message'          => 'nullable|string',
        ]);

        // Prevent double booking for the selected doctor
        if ($request->doctor_id) {
            $alreadyBooked = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->where('status', '!=', 'canceled') // ignore canceled
                ->exists();

            if ($alreadyBooked) {
                throw ValidationException::withMessages([
                    'appointment_time' => 'This doctor is already booked for the selected date and time. Please choose another slot.'
                ]);
            }
        }

        try {
            // Save appointment
            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'doctor_id' => $request->doctor_id, // integer reference
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'gender' => $request->gender,
                'department' => $request->department,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'message' => $request->message,
                'status' => 'upcoming',
            ]);
            // Send confirmation email
            Mail::to($appointment->email)
                ->send(new AppointmentConfirmation($appointment));

            // Google Calendar
            if ($request->appointment_date && $request->appointment_time) {
                $start = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);
                $end   = $start->copy()->addMinutes(30);

                $calendar->createEvent([
                    'full_name' => $request->full_name,
                    'message'   => $request->message,
                    'start'     => $start->toRfc3339String(),
                    'end'       => $end->toRfc3339String(),
                ]);
            }

            return back()->with('success', 'Appointment booked successfully! Confirmation email sent & added to Google Calendar.');
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->withErrors([
                'appointment_time' => 'This slot was just booked by someone else. Please select a different time.'
            ])->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Something went wrong. Please try again.'
            ])->withInput();
        }
    }

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
}
