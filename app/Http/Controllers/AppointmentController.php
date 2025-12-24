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
use Razorpay\Api\Api;

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
                    return response()->json([
                        'error' => 'This doctor is already booked for the selected date and time.'
                    ], 422);
                }
            }

            // Create appointment with pending status
            $appointment = Appointment::create(array_merge($validated, [
                'user_id' => Auth::id(),
                'status' => 'pending', // pending until payment
                'amount' => 500, // set your appointment amount
            ]));

            // Create Razorpay order
            $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $razorpayOrder = $api->order->create([
                'receipt' => 'appointment_' . $appointment->id,
                'amount' => $appointment->amount * 100, // in paise
                'currency' => 'INR',
            ]);

            $appointment->update([
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

            // Optional: Add to Google Calendar
            $start = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);
            $end   = $start->copy()->addMinutes(30);

            $calendar->createEvent([
                'full_name' => $request->full_name,
                'message'   => $request->message,
                'start'     => $start->toRfc3339String(),
                'end'       => $end->toRfc3339String(),
            ]);

            // Return JSON for AJAX payment
            return response()->json([
                'appointment_id' => $appointment->id,
                'amount' => $appointment->amount,
                'razorpay_order_id' => $appointment->razorpay_order_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong. Please try again.',
                'message' => $e->getMessage()
            ], 500);
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
