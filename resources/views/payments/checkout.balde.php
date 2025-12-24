@extends('layouts.app')

@section('title', 'Payment Appointment')

@section('content')
<div class="max-w-2xl p-8 mx-auto">
    <h2 class="mb-4 text-3xl font-bold">Pay for Your Appointment</h2>

    <p>Appointment ID: {{ $appointment->id }}</p>
    <p>Amount: ₹{{ $appointment->amount }}</p>

    <!-- Pay Button -->
    <button id="payBtn" 
            data-appointment-id="@json($appointment->id)" 
            data-amount="@json($appointment->amount)" 
            data-order-id="@json($appointment->razorpay_order_id ?? '')"
            class="px-6 py-3 mt-4 text-white bg-blue-600 rounded-lg">
        Pay Now
    </button>
</div>

<!-- Razorpay Checkout JS -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('payBtn').onclick = function() {
    // Get data from button attributes
    var btn = this;
    var appointmentId = btn.dataset.appointmentId;
    var amount = btn.dataset.amount * 100; // Convert to paise
    var orderId = btn.dataset.orderId;

    var options = {
        key: "{{ config('services.razorpay.key') }}",
        amount: amount,
        currency: "INR",
        name: "HealthCarePro",
        description: "Doctor Appointment",
        order_id: orderId,
        handler: function(response) {
            fetch("{{ route('payment.verify') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature,
                    appointment_id: appointmentId
                })
            })
            .then(res => res.json())
            .then(() => {
                window.location.href = "{{ route('appointment.confirmation', $appointment) }}";
            })
            .catch(err => alert('Payment verification failed.'));
        },
        prefill: {
            name: "{{ $appointment->full_name }}",
            email: "{{ $appointment->email }}",
            contact: "{{ $appointment->phone }}"
        },
        theme: {
            color: "#1d4ed8"
        }
    };

    new Razorpay(options).open();
};
</script>
@endsection
