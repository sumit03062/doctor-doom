<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmedMail;

class PaymentController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required',
            'appointment_id' => 'required|exists:appointments,id',
        ]);

        $generatedSignature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
            config('services.razorpay.secret')
        );

        if ($generatedSignature !== $request->razorpay_signature) {
            abort(403, 'Payment verification failed.');
        }

        $appointment = Appointment::findOrFail($request->appointment_id);

        $appointment->update([
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'payment_status' => 'paid',
            'status' => 'upcoming',
        ]);

        // Optional: send confirmation email
        // Mail::to($appointment->email)->send(new AppointmentConfirmedMail($appointment));

        return response()->json(['success' => true]);
    }
}
