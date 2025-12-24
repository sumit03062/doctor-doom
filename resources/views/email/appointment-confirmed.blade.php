<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment Confirmed</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f9fafb; padding:20px">

    <div style="max-width:600px; margin:auto; background:#ffffff; padding:20px; border-radius:8px">

        <h2 style="color:#16a34a">✅ Appointment Confirmed</h2>

        <p>Hello <strong>{{ $appointment->full_name }}</strong>,</p>

        <p>Your appointment has been successfully confirmed. Here are the details:</p>

        <table style="width:100%; margin-top:15px">
            <tr>
                <td><strong>Doctor</strong></td>
                <td>Dr. {{ optional($appointment->doctor)->name ?? 'Assigned Soon' }}</td>
            </tr>
            <tr>
                <td><strong>Department</strong></td>
                <td>{{ ucfirst($appointment->department) }}</td>
            </tr>
            <tr>
                <td><strong>Date</strong></td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td><strong>Time</strong></td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td style="color:#16a34a">Confirmed</td>
            </tr>
        </table>

        <p style="margin-top:20px">
            Thank you for choosing <strong>HealthCarePro</strong>.
        </p>

        <p>
            Regards,<br>
            <strong>HealthCarePro Team</strong>
        </p>

    </div>

</body>
</html>
