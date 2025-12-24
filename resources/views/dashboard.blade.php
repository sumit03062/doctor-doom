@extends('layouts.app')

@section('title', 'My Dashboard | MediCare Hospital')

@section('content')
<?php
// No need for hardcoded data anymore
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-btn {
            background: linear-gradient(to right, #10b981, #3b82f6);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #ccfbf1 0%, #dbeafe 50%, #e0e7ff 100%);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">

    <section class="w-full py-16 overflow-hidden md:py-20 lg:py-28 gradient-bg">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if(session('success'))
            <div class="p-6 mb-10 text-center text-white shadow-xl bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl">
                <p class="text-lg font-semibold">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Header -->
            <div class="mb-12 text-center">
                <h1 class="mb-4 text-4xl font-extrabold text-gray-900 md:text-5xl">
                    Welcome back, <span class="text-transparent bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text">{{ Auth::user()->name }}!</span>
                </h1>
                <p class="text-lg text-gray-600">Manage your health journey with ease</p>
            </div>

            <!-- Profile Card + Appointments Table -->
            <div class="grid grid-cols-1 gap-8 mb-12 lg:grid-cols-3">

                <!-- User Profile Card -->
                <!-- User Profile Card -->
                <div class="lg:col-span-1">
                    <div class="overflow-hidden bg-white border border-gray-100 shadow-xl rounded-3xl">
                        <div class="h-32 bg-gradient-to-r from-green-500 to-blue-600"></div>

                        <div class="relative px-8 pb-10 -mt-20 text-center">
                            <div class="relative inline-block">
                                <!-- Profile Picture with Fallback -->
                                <img src="{{ Auth::user()->profile_photo_url }}"
                                    alt="Profile Picture"
                                    class="object-cover w-40 h-40 mx-auto border-8 border-white rounded-full shadow-2xl">

                                <!-- Optional: Camera icon if you want to allow upload from dashboard too -->
                                <!-- Remove or comment out if not needed -->
                                <!--
                <a href="{{ route('profile.edit') }}" class="absolute cursor-pointer bottom-2 right-2">
                    <div class="flex items-center justify-center w-12 h-12 text-white transition-all duration-300 transform rounded-full shadow-lg bg-gradient-to-r from-green-500 to-blue-600 hover:shadow-2xl hover:scale-110">
                        <i data-lucide="camera" class="w-6 h-6"></i>
                    </div>
                </a>
                -->
                            </div>

                            <h3 class="mt-6 text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-500">Patient ID: #MC{{ str_pad(Auth::id(), 5, '0', STR_PAD_LEFT) }}</p>

                            <div class="mt-8 space-y-5 text-left">
                                <div class="flex items-center gap-4">
                                    <i data-lucide="cake" class="w-6 h-6 text-green-600"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Age</p>
                                        <p class="font-semibold text-gray-900">{{ Auth::user()->age ?? 'Not set' }} Years</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <i data-lucide="user" class="w-6 h-6 text-blue-600"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Gender</p>
                                        <p class="font-semibold text-gray-900">{{ Auth::user()->gender ? ucfirst(Auth::user()->gender) : 'Not set' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <i data-lucide="phone" class="w-6 h-6 text-purple-600"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Phone</p>
                                        <p class="font-semibold text-gray-900">{{ Auth::user()->phone ?? 'Not set' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <i data-lucide="mail" class="w-6 h-6 text-pink-600"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="font-semibold text-gray-900 break-all">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <i data-lucide="calendar" class="w-6 h-6 text-indigo-600"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Member Since</p>
                                        <p class="font-semibold text-gray-900">{{ Auth::user()->created_at->format('F Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="inline-block w-full py-3 mt-8 font-semibold text-center text-white transition-all duration-300 transform rounded-xl gradient-btn hover:shadow-xl hover:scale-105">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- All Appointments Table -->
                <div class="lg:col-span-2">
                    <div class="p-6 bg-white border border-gray-100 shadow-xl rounded-3xl">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="text-3xl font-bold">All Appointments</h1>
                            <span class="text-lg font-medium text-gray-600">{{ $appointments->count() }} Total</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-300 table-auto">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Date</th>
                                        <th class="px-4 py-3 text-left">Time</th>
                                        <th class="px-4 py-3 text-left">Department</th>
                                        <th class="px-4 py-3 text-left">Doctor</th>
                                        <th class="px-4 py-3 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($appointments as $appt)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $appt->appointment_date->format('d M Y') }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}</td>
                                        <td class="px-4 py-3">{{ ucwords($appt->department) }}</td>
                                        <td class="px-4 py-3">Dr. {{ $appt->doctor ? $appt->doctor->name : 'Any Available' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-3 py-1 text-xs rounded-full bg-amber-100 text-amber-800">
                                                Upcoming
                                            </span>
                                        </td>
                                        <td class="flex gap-2 px-4 py-3">
                                            @if($appt->status == 'upcoming')
                                            <!-- Edit / Reschedule -->
                                            <a href="{{ route('appointment.edit', $appt) }}" class="text-blue-600 hover:underline">Edit</a>

                                            <!-- Cancel -->
                                            <form action="{{ route('appointment.destroy', $appt) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button class="text-red-600 hover:underline" onclick="return confirm('Cancel appointment?')">Cancel</button>
                                            </form>
                                            @endif

                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                            No appointments booked yet.
                                        </td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments Cards -->
            @if($appointments->where('appointment_date', '>=', now())->count() > 0)
            <div class="mb-12">
                <div class="flex flex-col items-start justify-between mb-8 sm:flex-row sm:items-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:mb-0">Upcoming Appointments</h2>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    @foreach($appointments->where('appointment_date', '>=', now())->sortBy('appointment_date') as $appt)
                    <div class="p-6 transition-all duration-300 bg-white border border-gray-100 shadow-lg rounded-2xl hover:shadow-2xl">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900">
                                    {{ $appt->doctor ? 'Dr. ' . $appt->doctor->name : 'Any Available Doctor' }}
                                </h4>

                                <p class="text-gray-600">{{ ucwords(str_replace('_', ' ', $appt->department)) }}</p>
                            </div>
                            <span class="px-4 py-2 text-sm font-medium rounded-full bg-amber-100 text-amber-800">
                                Upcoming
                            </span>
                        </div>

                        <div class="flex items-center gap-6 mb-4 text-gray-600">
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                                <span>{{ $appt->appointment_date->format('F d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                                <span>{{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}</span>
                            </div>
                        </div>

                        @if($appt->message)
                        <p class="text-sm italic text-gray-600">"{{ Str::limit($appt->message, 100) }}"</p>
                        @endif

                        <div class="flex gap-3 mt-5">
                            <button class="flex-1 py-3 font-medium text-white transition-all transform bg-gradient-to-r from-green-500 to-blue-500 rounded-xl hover:shadow-lg hover:scale-105">
                                Join Virtual Visit
                            </button>
                            <a href="{{ route('appointment.edit', $appt) }}">
                                <button class="px-6 py-3 font-medium transition border border-gray-300 rounded-xl hover:bg-gray-50">
                                Reschedule
                            </button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                <a href="{{ url('/') }}#appointment" class="p-6 text-center transition-all duration-300 transform bg-white border border-gray-100 shadow-lg rounded-2xl hover:shadow-2xl hover:-translate-y-2">
                    <div class="inline-flex items-center justify-center mx-auto mb-4 w-14 h-14 bg-gradient-to-r from-green-100 to-blue-100 rounded-2xl">
                        <i data-lucide="calendar-plus" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900">Book New</h4>
                    <p class="mt-1 text-sm text-gray-600">New Appointment</p>
                </a>

                <a href="#" class="p-6 text-center transition-all duration-300 transform bg-white border border-gray-100 shadow-lg rounded-2xl hover:shadow-2xl hover:-translate-y-2">
                    <div class="inline-flex items-center justify-center mx-auto mb-4 bg-purple-100 w-14 h-14 rounded-2xl">
                        <i data-lucide="file-text" class="w-8 h-8 text-purple-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900">Medical Records</h4>
                    <p class="mt-1 text-sm text-gray-600">View Reports</p>
                </a>

                <a href="#" class="p-6 text-center transition-all duration-300 transform bg-white border border-gray-100 shadow-lg rounded-2xl hover:shadow-2xl hover:-translate-y-2">
                    <div class="inline-flex items-center justify-center mx-auto mb-4 bg-pink-100 w-14 h-14 rounded-2xl">
                        <i data-lucide="pill" class="w-8 h-8 text-pink-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900">Prescriptions</h4>
                    <p class="mt-1 text-sm text-gray-600">Current Meds</p>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="contents">
                    @csrf
                    <button type="submit" class="p-6 text-center transition-all duration-300 transform bg-white border border-red-200 shadow-lg rounded-2xl hover:shadow-2xl hover:-translate-y-2 hover:bg-red-50">
                        <div class="inline-flex items-center justify-center mx-auto mb-4 bg-red-100 w-14 h-14 rounded-2xl">
                            <i data-lucide="log-out" class="w-8 h-8 text-red-600"></i>
                        </div>
                        <h4 class="font-semibold text-red-700">Sign Out</h4>
                        <p class="mt-1 text-sm text-gray-600">End Session</p>
                    </button>
                </form>
            </div>

        </div>
    </section>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
@endsection