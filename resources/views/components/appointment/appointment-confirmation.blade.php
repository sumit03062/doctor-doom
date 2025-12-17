<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmation</title>
</head>
<body>
    <h2>✅ Appointment Confirmed</h2>

    <p>Hello <strong>{{ $appointment->full_name }}</strong>,</p>

    <p>Your appointment has been successfully booked. Here are the details:</p>

    <ul>
        <li><strong>Department:</strong> {{ ucfirst($appointment->department) }}</li>
        <li><strong>Doctor:</strong> {{ $appointment->doctor ?? 'Any available doctor' }}</li>
        <li><strong>Date:</strong> {{ $appointment->appointment_date }}</li>
        <li><strong>Time:</strong> {{ $appointment->appointment_time }}</li>
    </ul>

    @if($appointment->message)
        <p><strong>Your Notes:</strong> {{ $appointment->message }}</p>
    @endif

    <p>📍 Please arrive 10 minutes early.</p>

    <p>Thank you for choosing our clinic.</p>

    <p>
        Regards,<br>
        <strong>Clinic Team</strong>
    </p>
</body>
</html>
