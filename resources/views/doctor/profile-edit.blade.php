@extends('layouts.app')

@section('title', 'Edit Doctor Profile')

@section('content')
<div class="max-w-4xl py-24 mx-auto">
    @if(session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-8 bg-white shadow-xl rounded-3xl">
        <form method="POST" action="{{ route('doctor.profile-edit') }}" enctype="multipart/form-data">
            @csrf

            <!-- Profile Image -->
            <div class="mb-5">
                <x-input-label value="Profile Image" />
                <input type="file" name="profile_photo" class="w-full mt-1" />
            </div>

            <!-- Full Name -->
            <div class="mb-5">
                <x-input-label value="Full Name" />
                <x-text-input name="name" value="{{ old('name', $doctor->name) }}" class="w-full mt-1" />
            </div>

            <!-- Age -->
            <div class="mb-5">
                <x-input-label value="Age" />
                <x-text-input type="number" name="age" value="{{ old('age', $doctor->age) }}" class="w-full mt-1" />
            </div>

            <!-- Gender -->
            <div class="mb-5">
                <x-input-label value="Gender" />
                <select name="gender" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-indigo-500">
                    <option value="">Select</option>
                    <option value="male" @selected($doctor->gender=='male')>Male</option>
                    <option value="female" @selected($doctor->gender=='female')>Female</option>
                    <option value="other" @selected($doctor->gender=='other')>Other</option>
                </select>
            </div>

            <!-- Specialization -->
            <div class="mb-5">
                <x-input-label value="Specialization" />
                <x-text-input name="specialization" placeholder="Cardiologist, Dentist..." value="{{ old('specialization', $doctor->specialization) }}" class="w-full mt-1"/>
            </div>

            <!-- Experience -->
            <div class="mb-5">
                <x-input-label value="Experience (Years)" />
                <x-text-input type="number" name="experience" value="{{ old('experience', $doctor->experience) }}" class="w-full mt-1"/>
            </div>

            <!-- Qualification -->
            <div class="mb-5">
                <x-input-label value="Qualification" />
                <x-text-input name="qualification" placeholder="MBBS, MD..." value="{{ old('qualification', $doctor->qualification) }}"  class="w-full mt-1"/>
            </div>

            <!-- About / Bio -->
            <div class="mb-5">
                <x-input-label value="About / Bio" />
                <textarea name="about" rows="4" class="w-full mt-1 border-gray-300 rounded-xl focus:ring-indigo-500" placeholder="Short bio about doctor">{{ old('about', $doctor->about) }}</textarea>
            </div>

            <!-- Medals / Achievements -->
            <div class="mb-5">
                <x-input-label value="Medals / Achievements" />
                <textarea name="medals" rows="2" class="w-full mt-1 border-gray-300 rounded-xl focus:ring-indigo-500" placeholder="Awards, Medals, Recognitions">{{ old('medals', $doctor->medals) }}</textarea>
            </div>

            <!-- Clinic Name -->
            <div class="mb-5">
                <x-input-label value="Clinic / Hospital Name" />
                <x-text-input name="clinic_name" value="{{ old('clinic_name', $doctor->clinic_name) }}" class="w-full mt-1" />
            </div>

            <!-- Clinic Address -->
            <div class="mb-5">
                <x-input-label value="Clinic Address" />
                <textarea name="clinic_address" rows="2" class="w-full mt-1 border-gray-300 rounded-xl focus:ring-indigo-500">{{ old('clinic_address', $doctor->clinic_address) }}</textarea>
            </div>

            <!-- Consultation Fees -->
            <div class="mb-5">
                <x-input-label value="Consultation Fees" />
                <x-text-input type="number" name="fees" value="{{ old('fees', $doctor->fees) }}" class="w-full mt-1" />
            </div>

            <!-- Save / Cancel -->
            <div class="flex gap-4 mt-6">
                <x-primary-button>Save Changes</x-primary-button>
                <a href="{{ route('doctor.dashboard') }}" class="px-6 py-2 text-gray-600 border rounded-xl hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
