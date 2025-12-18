<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Breeze User Profile
    |--------------------------------------------------------------------------
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

    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = $request->user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $path = $request->file('profile_photo')
            ->store('profile-photos', 'public');

        $user->update([
            'profile_photo_path' => $path
        ]);

        return back()->with('status', 'profile-photo-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'account-deleted');
    }

    /*
    |--------------------------------------------------------------------------
    | Doctor Profile (SEPARATE TABLE)
    |--------------------------------------------------------------------------
    */

    public function editDoctor(): View
    {
        return view('doctor.profile-edit', [
            'user'   => Auth::user(),
            'doctor' => Auth::user()->doctorProfile
        ]);
    }

    public function updateDoctor(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:18|max:100',
            'gender' => 'nullable|in:male,female,other',

            'specialization' => 'required|string|max:255',
            'experience' => 'nullable|integer|min:0|max:60',
            'qualification' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'medals' => 'nullable|string',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string',
            'fees' => 'nullable|numeric|min:0',

            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::transaction(function () use ($request, $user) {

            /* -------------------------
             | 1️⃣ USER TABLE
             -------------------------*/
            if ($request->hasFile('profile_photo')) {
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }

                $path = $request->file('profile_photo')
                    ->store('profile-photos', 'public');

                $user->profile_photo_path = $path;
            }

            $user->update([
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
            ]);

            /* -------------------------
             | 2️⃣ DOCTOR TABLE
             -------------------------*/
            Doctor::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => $user->name,
                    'email' => $user->email, // ✅ ADD THIS
                    'specialization' => $request->specialization,
                    'experience' => $request->experience,
                    'qualification' => $request->qualification,
                    'bio' => $request->about,
                    'medals' => $request->medals,
                    'clinic_name' => $request->clinic_name,
                    'clinic_address' => $request->clinic_address,
                    'fees' => $request->fees,
                ]
            );
        });

        return back()->with('success', 'Doctor profile updated successfully.');
    }
}
