<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmedMail;

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
     * Store appointment (Create appointment + Razorpay order)
     */
    public function store(Request $request)
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

            // STEP 1: Create appointment (pending)
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
                'status'           => 'pending',
                'payment_status'   => 'pending',
                'amount'           => 50000, // ₹500 (paise)
            ]);

            // STEP 2: Create Razorpay order
            $razorpay = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $order = $razorpay->order->create([
                'receipt'  => 'APT_' . $appointment->id,
                'amount'   => $appointment->amount,
                'currency' => 'INR',
            ]);

            // Save Razorpay order id
            $appointment->update([
                'razorpay_order_id' => $order['id'],
            ]);

            // STEP 3: Go to payment page
            return redirect()->route('payment.checkout', $appointment->id);


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

        $cancelBy = $user->id === $appointment->user_id
            ? 'patient'
            : ($user->role === 'doctor' ? 'doctor' : 'admin');

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

        // Prevent double booking
        if ($request->doctor_id) {
            $alreadyBooked = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->where('status', '!=', 'canceled')
                ->where('id', '!=', $appointment->id)
                ->exists();

            if ($alreadyBooked) {
                throw ValidationException::withMessages([
                    'appointment_time' => 'This doctor is already booked for this slot.'
                ]);
            }
        }

        $appointment->update($validated);

        return back()->with('success', 'Appointment updated successfully.');
    }
}
