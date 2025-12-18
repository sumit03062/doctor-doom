@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="max-w-4xl px-6 py-12 mx-auto">

    <h1 class="mb-8 text-3xl font-bold text-gray-800">
        Edit Appointment
    </h1>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointment.update', $appointment->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Full Name --}}
        <div>
            <label class="block mb-2 font-semibold">Full Name</label>
            <input type="text" name="full_name"
                value="{{ old('full_name', $appointment->full_name) }}"
                class="w-full px-4 py-3 border rounded-xl">
        </div>

        {{-- Email --}}
        <div>
            <label class="block mb-2 font-semibold">Email</label>
            <input type="email" name="email"
                value="{{ old('email', $appointment->email) }}"
                class="w-full px-4 py-3 border rounded-xl">
        </div>

        {{-- Phone --}}
        <div>
            <label class="block mb-2 font-semibold">Phone</label>
            <input type="text" name="phone"
                value="{{ old('phone', $appointment->phone) }}"
                class="w-full px-4 py-3 border rounded-xl">
        </div>

        {{-- Age --}}
        <div>
            <label class="block mb-2 font-semibold">Age</label>
            <input type="number" name="age"
                value="{{ old('age', $appointment->age) }}"
                class="w-full px-4 py-3 border rounded-xl">
        </div>

        {{-- Gender --}}
        <div>
            <label class="block mb-2 font-semibold">Gender</label>
            <select name="gender" class="w-full px-4 py-3 border rounded-xl">
                <option value="">Select</option>
                <option value="Male" {{ $appointment->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $appointment->gender == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ $appointment->gender == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        {{-- Department --}}
        <div>
            <label class="block mb-2 font-semibold">Department</label>
            <input type="text" name="department"
                value="{{ old('department', $appointment->department) }}"
                class="w-full px-4 py-3 border rounded-xl">
        </div>

        {{-- Doctor --}}
        <div>
            <label class="block mb-2 font-semibold">Doctor</label>
            <select name="doctor_id" class="w-full px-4 py-3 border rounded-xl">
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
            <label class="block mb-2 font-semibold">Appointment Date</label>
            <input type="date" name="appointment_date"
                value="{{ old('appointment_date', $appointment->appointment_date) }}"
                class="w-full px-4 py-3 border rounded-xl">
        </div>

        {{-- Time --}}
        <div>
            <label class="block mb-2 font-semibold">Appointment Time</label>
            <input type="time" name="appointment_time"
                value="{{ old('appointment_time', $appointment->appointment_time) }}"
                class="w-full px-4 py-3 border rounded-xl">
        </div>

        {{-- Message --}}
        <div>
            <label class="block mb-2 font-semibold">Message</label>
            <textarea name="message" rows="4"
                class="w-full px-4 py-3 border rounded-xl">{{ old('message', $appointment->message) }}</textarea>
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                class="px-8 py-4 font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                Update Appointment
            </button>
        </div>
    </form>
</div>
@endsection
