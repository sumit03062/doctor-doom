<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\update;
use App\Models\Doctor;

class ProfileController extends Controller
{
    /**
     * =========================
     * Breeze User Profile
     * =========================
     */

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $user->fill([
            'name'   => $validated['name'],
            'email'  => $validated['email'],
            'age'    => $validated['age'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'phone'  => $validated['phone'] ?? null,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Update profile photo
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = $request->user();

        if (
            $user->profile_photo_path &&
            Storage::disk('public')->exists($user->profile_photo_path)
        ) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $file = $request->file('profile_photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('profile-photos', $fileName, 'public');

        $user->profile_photo_path = 'profile-photos/' . $fileName;
        $user->save();

        return back()->with('status', 'profile-photo-updated');
    }

    /**
     * Delete account
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if (
            $user->profile_photo_path &&
            Storage::disk('public')->exists($user->profile_photo_path)
        ) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')
            ->with('status', 'account-deleted');
    }

    /**
     * =========================
     * Doctor Profile
     * =========================
     */

    public function editDoctor(): View
    {
        return view('doctor.profile-edit', [
            'doctor' => Auth::user(),
        ]);
    }

    public function updateDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone'         => 'nullable|string|max:15',
            'gender'        => 'nullable|in:male,female,other',
            'specialization' => 'required|string|max:255',
            'experience' => 'required|integer|min:0|max:60',
            'qualification' => 'required|string|max:255',
            'about' => 'nullable|string|max:1000',
            'medals' => 'nullable|string|max:1000',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string|max:500',
            'fees' => 'nullable|integer',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = Auth::user();

        $user->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'gender' => $request->gender,
    ]);

        // Check if doctor record exists
        $doctor = $user->doctor;

        if (!$doctor) {
            // Create new doctor record
            $doctor = $user->doctor()->create([
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
            // Update existing record
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

        // Handle profile photo
        if ($request->hasFile('profile_photo')) {
            if ($doctor->profile_photo_path && Storage::disk('public')->exists($doctor->profile_photo_path)) {
                Storage::disk('public')->delete($doctor->profile_photo_path);
            }

            $file = $request->file('profile_photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile-photos', $fileName, 'public');

            $doctor->profile_photo_path = 'profile-photos/' . $fileName;
            $doctor->save();
        }

        return redirect()->route('doctor.dashboard')->with('success', 'Profile updated successfully');
    }
}
