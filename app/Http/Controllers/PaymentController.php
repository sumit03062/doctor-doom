<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmedMail;

class PaymentController extends Controller
{
    /**
     * Verify Razorpay Payment
     */
    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_order_id'   => 'required',
            'razorpay_payment_id'=> 'required',
            'razorpay_signature' => 'required',
        ]);

        // Verify signature
        $generatedSignature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
            config('services.razorpay.secret')
        );

        if ($generatedSignature !== $request->razorpay_signature) {
            abort(403, 'Payment verification failed.');
        }

        // Find appointment
        $appointment = Appointment::where(
            'razorpay_order_id',
            $request->razorpay_order_id
        )->firstOrFail();

        // Update payment status
        $appointment->update([
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'payment_status'      => 'paid',
            'status'              => 'upcoming',
        ]);

        // Send confirmation email
        Mail::to($appointment->email)
            ->send(new AppointmentConfirmedMail($appointment));

        return redirect()
            ->route('appointment.confirmation', $appointment)
            ->with('success', 'Payment successful! Appointment confirmed.');
    }

    public function checkout(Appointment $appointment)
{
    return view('payments.checkout', compact('appointment'));
}
}

