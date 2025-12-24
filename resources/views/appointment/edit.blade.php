@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="min-h-screen px-4 py-24 bg-gradient-to-br from-blue-50 via-white to-blue-100">

    {{-- Page Header --}}
    <div class="max-w-5xl mx-auto mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-800">
            Edit <span class="text-transparent bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text">Appointment</span>
        </h1>
        <p class="mt-2 text-gray-600">
            Update patient and appointment details carefully
        </p>
    </div>

    {{-- Form Card --}}
    <div class="max-w-5xl p-10 mx-auto bg-white shadow-2xl rounded-3xl">

        {{-- Errors --}}
        @if ($errors->any())
            <div class="p-5 mb-8 border border-red-200 rounded-xl bg-red-50">
                <ul class="text-red-700 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointment.update', $appointment->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Grid Layout --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Full Name --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Full Name</label>
                    <input type="text" name="full_name"
                        value="{{ old('full_name', $appointment->full_name) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $appointment->email) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Phone</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $appointment->phone) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Age --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Age</label>
                    <input type="number" name="age"
                        value="{{ old('age', $appointment->age) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Gender --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Gender</label>
                    <select name="gender"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Select</option>
                        <option value="Male" {{ $appointment->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $appointment->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ $appointment->gender == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                {{-- Department --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Department</label>
                    <input type="text" name="department"
                        value="{{ old('department', $appointment->department) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Doctor --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Doctor</label>
                    <select name="doctor_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Any Available</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}"
                                {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                Dr. {{ $doctor->name }} ({{ $doctor->specialization ?? 'General' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Appointment Date</label>
                    <input type="date" name="appointment_date"
                        value="{{ old('appointment_date', $appointment->appointment_date) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Time --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Appointment Time</label>
                    <input type="time" name="appointment_time"
                        value="{{ old('appointment_time', $appointment->appointment_time) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

            </div>

            {{-- Message --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Message</label>
                <textarea name="message" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('message', $appointment->message) }}</textarea>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end pt-6">
                <button type="submit"
                    class="px-8 py-4 font-semibold text-center text-white rounded-full shadow-lg tilt-btn bg-gradient-to-r from-green-500 to-blue-500">
                    Update Appointment
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
