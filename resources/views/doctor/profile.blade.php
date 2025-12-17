@extends('layouts.app')

@section('title', 'Doctor Profile')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-6xl px-4 mx-auto">

        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-extrabold text-gray-900">
                Doctor Profile
            </h1>
            <p class="mt-2 text-gray-600">
                Complete professional details
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <!-- LEFT PROFILE CARD -->
            <div class="bg-white shadow-xl rounded-3xl overflow-hidden">
                <div class="h-32 bg-gradient-to-r from-green-500 to-blue-600"></div>

                <div class="relative px-6 pb-8 -mt-16 text-center">
                    <img
                        src="{{ Auth::user()->profile_photo_url }}"
                        class="object-cover w-36 h-36 mx-auto border-8 border-white rounded-full shadow-lg"
                        alt="Doctor Photo"
                    >

                    <h2 class="mt-4 text-2xl font-bold text-gray-900">
                        Dr. {{ Auth::user()->name }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ Auth::user()->specialization ?? 'Medical Specialist' }}
                    </p>

                    <span class="inline-block px-4 py-1 mt-4 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                        Verified Doctor
                    </span>

                    <div class="mt-6">
                        <a href="{{ route('doctor.profile-edit') }}"
                           class="inline-block px-6 py-2 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- RIGHT DETAILS -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Personal Info -->
                <div class="p-6 bg-white shadow-xl rounded-3xl">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        Personal Information
                    </h3>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not provided' }}</p>
                        <p><strong>Gender:</strong> {{ Auth::user()->gender_display ?? 'Not specified' }}</p>
                        <p><strong>Age:</strong> {{ Auth::user()->age ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Professional Info -->
                <div class="p-6 bg-white shadow-xl rounded-3xl">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        Professional Information
                    </h3>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <p><strong>Specialization:</strong> {{ Auth::user()->specialization ?? 'General Physician' }}</p>
                        <p><strong>Experience:</strong> {{ Auth::user()->experience ?? '0' }} Years</p>
                        <p><strong>Consultation Fee:</strong> ₹{{ Auth::user()->consultation_fee ?? 'N/A' }}</p>
                        <p><strong>Available Days:</strong> {{ Auth::user()->available_days ?? 'Not set' }}</p>
                    </div>
                </div>

                <!-- About Doctor -->
                <div class="p-6 bg-white shadow-xl rounded-3xl">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        About Doctor
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        {{ Auth::user()->about ?? 'No description added yet.' }}
                    </p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div class="p-6 text-center bg-white shadow-xl rounded-3xl">
                        <h4 class="text-3xl font-bold text-green-600">
                            {{ Auth::user()->doctorAppointments()->count() }}
                        </h4>
                        <p class="mt-2 text-sm text-gray-500">
                            Total Appointments
                        </p>
                    </div>

                    <div class="p-6 text-center bg-white shadow-xl rounded-3xl">
                        <h4 class="text-3xl font-bold text-blue-600">
                            {{ Auth::user()->doctorAppointments()->whereDate('appointment_date','>=',today())->count() }}
                        </h4>
                        <p class="mt-2 text-sm text-gray-500">
                            Upcoming
                        </p>
                    </div>

                    <div class="p-6 text-center bg-white shadow-xl rounded-3xl">
                        <h4 class="text-3xl font-bold text-purple-600">
                            {{ Auth::user()->created_at->format('Y') }}
                        </h4>
                        <p class="mt-2 text-sm text-gray-500">
                            Joined Year
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
