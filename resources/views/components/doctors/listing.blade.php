<section class="relative w-full py-12 bg-white md:py-20 lg:py-28">
    <div class="px-6 mx-auto max-w-7xl">

        <!-- Section Heading -->
        <h2 class="mb-10 text-4xl font-bold text-center text-gray-900">
            Meet Our Expert Doctors
        </h2>

        <!-- Doctors Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($doctors as $doctor)
            <div class="relative p-6 bg-white shadow-md rounded-3xl">

                <!-- Profile Image + Basic Info -->
                <div class="flex items-center gap-4 mb-4">
                    <img src="{{ $doctor->profile_photo_path ? asset('storage/'.$doctor->profile_photo_path) : asset('default-doctor.png') }}" alt="{{ $doctor->name }}" class="object-cover w-16 h-16 rounded-full">
                    <div>
                        <h3 class="mt-6 text-2xl font-bold text-gray-900">Dr. {{  $doctor->user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $doctor->specialization }}</p>
                    </div>
                </div>

                <!-- Clinic & Fees -->
                <p class="mb-2 text-sm text-gray-600">Clinic: {{ $doctor->clinic_name }}</p>
                <p class="mb-2 text-sm text-gray-600">Fees: ₹{{ $doctor->fees }}</p>

                <!-- View More Toggle -->
                <button
                    class="mt-3 font-medium text-indigo-600 hover:underline"
                    onclick="toggleDoctorDetails({{ $doctor->id }})">
                    View More
                </button>

                

                <!-- Expanded Details (Initially Hidden) -->
                <div id="doctor-details-{{ $doctor->id }}" class="hidden pt-4 mt-4 space-y-2 text-sm text-gray-700 border-t">
                    <p><strong>Age:</strong> {{ $doctor->user->age ?? '-' }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($doctor->user->gender  ?? '-') }}</p>
                    <p><strong>Experience:</strong> {{ $doctor->experience ?? 0 }} years</p>
                    <p><strong>Qualification:</strong> {{ $doctor->qualification ?? '-' }}</p>
                    <p><strong>About / Bio:</strong> {{ $doctor->about ?? 'N/A' }}</p>
                    <p><strong>Medals / Achievements:</strong> {{ $doctor->medals ?? 'N/A' }}</p>
                    <p><strong>Clinic Address:</strong> {{ $doctor->clinic_address ?? 'N/A' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Toggle Script -->
    <script>
        function toggleDoctorDetails(id) {
            const details = document.getElementById(`doctor-details-${id}`);
            details.classList.toggle('hidden');
        }
    </script>
</section>