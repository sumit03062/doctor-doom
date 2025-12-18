<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_id',
        'specialization',
        'experience',
        'qualification',
        'bio',
        'medals',
        'clinic_name',
        'clinic_address',
        'fees',
        'profile_photo_path',
    ];

    // Link to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
