

<button id="payBtn" class="btn-primary">Pay Now</button>

<script>
var options = {
    key: "{{ config('services.razorpay.key') }}",
    amount: "{{ $appointment->amount }}",
    currency: "INR",
    name: "HealthCarePro",
    description: "Doctor Appointment",
    order_id: "{{ $appointment->razorpay_order_id }}",
    handler: function (response){
        fetch("{{ route('payment.verify') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify(response)
        }).then(() => window.location.href = "{{ route('dashboard') }}");
    }
};
new Razorpay(options).open();
</script>
