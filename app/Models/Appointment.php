<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'doctor_id',
        'full_name',
        'email',
        'phone',
        'age',
        'gender',
        'department',
        'doctor',
        'appointment_date',
        'appointment_time',
        'message',
        'google_event_id',
        'status',
        'canceled_by',
        'payment_status',
        'amount',
        'razorpay_order_id',
    ];

    protected $casts = [
        'appointment_date' => 'date', // ✅ cast as Carbon date
        'appointment_time' => 'string', // optional if you want Carbon time
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
