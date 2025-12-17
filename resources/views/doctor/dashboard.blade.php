@extends('layouts.app')

@section('title', 'Doctor Dashboard')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl">

        <!-- HEADER -->
        <div class="mb-10">
            <h1 class="text-4xl font-extrabold text-gray-900">
                Doctor Dashboard
            </h1>

            <div class="flex flex-col gap-4 mt-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-gray-600">
                    Welcome back, Dr. {{ Auth::user()->name }}
                </p>

                <div class="flex gap-3">
                    <a href="{{ route('doctor.profile-edit') }}"
                       class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                        Edit Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2 text-sm font-semibold text-red-600 border border-red-600 rounded-xl hover:bg-red-50">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- QUICK STATS -->
        <div class="grid grid-cols-1 gap-6 mb-12 sm:grid-cols-3">
            <div class="p-6 bg-white shadow rounded-2xl">
                <p class="text-sm text-gray-500">Total Appointments</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">
                    {{ $appointments->count() }}
                </p>
            </div>

            <div class="p-6 bg-white shadow rounded-2xl">
                <p class="text-sm text-gray-500">Upcoming</p>
                <p class="mt-2 text-3xl font-bold text-blue-600">
                    {{ $appointments->where('appointment_date', '>=', now()->toDateString())->count() }}
                </p>
            </div>

            <div class="p-6 bg-white shadow rounded-2xl">
                <p class="text-sm text-gray-500">Completed</p>
                <p class="mt-2 text-3xl font-bold text-green-600">
                    {{ $appointments->where('status', 'completed')->count() }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <!-- PROFILE CARD -->
            @php
                $doctor = Auth::user()->doctor;
            @endphp

            <div class="lg:col-span-1">
                <div class="overflow-hidden bg-white shadow-xl rounded-3xl">
                    <div class="h-32 bg-gradient-to-r from-green-500 to-blue-600"></div>

                    <div class="relative px-8 pb-10 -mt-20 text-center">
                        <img src="{{ Auth::user()->profile_photo_url }}"
                             class="object-cover w-40 h-40 mx-auto border-8 border-white rounded-full shadow-2xl"
                             alt="Doctor Photo">

                        <h3 class="mt-6 text-2xl font-bold text-gray-900">
                            Dr. {{ Auth::user()->name }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $doctor->specialization ?? 'Specialization not set' }}
                        </p>

                        <div class="mt-6 space-y-3 text-sm text-left text-gray-600">
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Gender:</strong> {{ Auth::user()->gender ?? 'Not set' }}</p>
                            <p><strong>Experience:</strong> {{ $doctor->experience ?? 'N/A' }} years</p>
                            <p><strong>Qualification:</strong> {{ $doctor->qualification ?? 'N/A' }}</p>
                            <p><strong>Clinic:</strong> {{ $doctor->clinic_name ?? 'Not set' }}</p>
                            <p><strong>Fees:</strong> ₹{{ $doctor->fees ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- APPOINTMENTS -->
            <div class="lg:col-span-2">
                <div class="p-6 bg-white shadow rounded-3xl">
                    <h3 class="mb-6 text-2xl font-bold text-gray-900">
                        Your Appointments
                    </h3>

                    @if($appointments->count())
                        <div class="space-y-4">
                            @foreach($appointments as $appointment)
                                <div class="flex flex-col gap-4 p-5 border rounded-2xl sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $appointment->patient->name }}
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            {{ $appointment->appointment_date }} • {{ $appointment->appointment_time }}
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            Reason: {{ $appointment->message ?? 'General Consultation' }}
                                        </p>
                                    </div>

                                    <span class="px-4 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                                        {{ ucfirst($appointment->status ?? 'booked') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-12 text-center text-gray-500">
                            No appointments yet. Patients will appear here once booked.
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="pt-12 text-sm text-center text-gray-400">
            © {{ date('Y') }} Doctor Portal. All rights reserved.
        </div>

    </div>
</section>
@endsection
