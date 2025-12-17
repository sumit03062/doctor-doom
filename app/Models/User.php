<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'age',
        'gender',
        'profile_photo_path',
        'role', // doctor or user
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Appended attributes
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'age'               => 'integer',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
        ];
    }

    /**
     * Profile photo accessor
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        return 'https://ui-avatars.com/api/?name='
            . urlencode($this->name)
            . '&background=10b981&color=fff&size=256';
    }

    /**
     * Gender display accessor
     */
    public function getGenderDisplayAttribute(): string
    {
        return match ($this->gender) {
            'male'   => 'Male',
            'female' => 'Female',
            'other'  => 'Other',
            default  => 'Not specified',
        };
    }

    /**
     * Appointments booked by this user (patient)
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Appointments where this user is the doctor
     */
    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    /**
     * Upcoming appointments (patient side)
     */
    public function upcomingAppointments()
    {
        return $this->hasMany(Appointment::class)
            ->whereDate('appointment_date', '>=', today())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time');
    }

    /**
     * Total appointments count (patient)
     */
    public function getTotalAppointmentsAttribute(): int
    {
        return $this->appointments()->count();
    }

    /**
     * Upcoming appointments count
     */
    public function getUpcomingCountAttribute(): int
    {
        return $this->upcomingAppointments()->count();
    }

    /**
     * Role helpers
     */
    public function isDoctor(): bool
    {
        return $this->role === 'doctor';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Doctor profile relation
     * ✅ This will allow Auth::user()->doctor
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
