<?php


namespace App\Services;

use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;

class DoctorProfileService
{
    public function saveUserProfile($user, $request)
    {
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')
                            ->store('profile-photos', 'public');

            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = $path;
        }

        $user->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);
    }

    public function saveDoctorProfile($user, $request)
    {
        $doctor = Doctor::where('user_id', $user->id)->first();

        if (!$doctor) {
            Doctor::create([
                'user_id' => $user->id,
                'specialization' => $request->specialization,
                'experience' => $request->experience,
                'qualification' => $request->qualification,
                'about' => $request->about,
                'medals' => $request->medals,
                'clinic_name' => $request->clinic_name,
                'clinic_address' => $request->clinic_address,
                'fees' => $request->fees,
            ]);
        } else {
            $doctor->update([
                'specialization' => $request->specialization,
                'experience' => $request->experience,
                'qualification' => $request->qualification,
                'about' => $request->about,
                'medals' => $request->medals,
                'clinic_name' => $request->clinic_name,
                'clinic_address' => $request->clinic_address,
                'fees' => $request->fees,
            ]);
        }
    }
}
