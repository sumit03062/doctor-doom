<section class="relative w-full py-12 bg-white md:py-20 lg:py-28">
    <div class="px-6 mx-auto max-w-7xl">

        <!-- Section Heading -->
        <h2 class="mb-10 text-4xl font-bold text-center text-brand">
            Meet Our Expert Doctors
        </h2>

        <!-- Doctors Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($doctors as $doctor)
            <div class="relative p-6 transition duration-300 transform bg-white shadow-lg rounded-3xl hover:shadow-2xl hover:-translate-y-1">

                <!-- Profile Image + Basic Info -->
                <div class="flex items-center gap-4 mb-4">
                    <img src="{{ $doctor->user->profile_photo_url ?? asset('default-doctor.png') }}"
                        alt="{{ $doctor->user->name }}"
                        class="object-cover w-16 h-16 border-2 rounded-full border-green-primary">
                    <div>
                        <h3 class="text-xl font-bold text-dark">Dr. {{ $doctor->user->name }}</h3>
                        <p class="text-sm text-muted">{{ $doctor->specialization }}</p>
                    </div>
                </div>

                <!-- Clinic & Fees -->
                <p class="mb-2 text-sm text-muted">Clinic: {{ $doctor->clinic_name }}</p>
                <p class="mb-4 text-sm text-muted">Fees: ₹{{ $doctor->fees }}</p>

                <!-- View More Button -->
                <button
                    class="px-4 py-2 font-medium transition rounded-full shadow btn-primary hover:shadow-lg"
                    onclick="openDoctorModal('{{ $doctor->id }}')">
                    View More
                </button>

            </div>

            <!-- Modal -->
            <!-- Modal -->
            <div id="doctor-modal-{{ $doctor->id }}"
                class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
                <div class="relative w-11/12 max-w-lg p-6 bg-white shadow-xl rounded-2xl">

                    <!-- Close Button -->
                    <button class="absolute text-gray-500 top-4 right-4 hover:text-red-500"
                        onclick="closeDoctorModal('{{ $doctor->id }}')">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>

                    <!-- Modal Content -->
                    <h3 class="mb-4 text-2xl font-bold text-dark">Dr. {{ $doctor->user->name }}</h3>
                    <p class="mb-2 text-sm text-muted"><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>Clinic:</strong> {{ $doctor->clinic_name }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>Fees:</strong> ₹{{ $doctor->fees }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>Age:</strong> {{ $doctor->user->age ?? '-' }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>Gender:</strong> {{ ucfirst($doctor->user->gender ?? '-') }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>Experience:</strong> {{ $doctor->experience ?? 0 }} years</p>
                    <p class="mb-2 text-sm text-muted"><strong>Qualification:</strong> {{ $doctor->qualification ?? '-' }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>About / Bio:</strong> {{ $doctor->bio ?? 'N/A' }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>Medals / Achievements:</strong> {{ $doctor->medals ?? 'N/A' }}</p>
                    <p class="mb-2 text-sm text-muted"><strong>Clinic Address:</strong> {{ $doctor->clinic_address ?? 'N/A' }}</p>

                    <!-- Appointment Button -->
                    <div class="mt-6 text-center">
                        <a href="#appointment" class="inline-block px-6 py-2 rounded-full shadow-lg btn-primary hover:shadow-xl">
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>


            @endforeach
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        function openDoctorModal(id) {
            const modal = document.getElementById(`doctor-modal-${id}`);
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // important: make flex to center content
        }

        function closeDoctorModal(id) {
            const modal = document.getElementById(`doctor-modal-${id}`);
            modal.classList.add('hidden');
            modal.classList.remove('flex'); // remove flex when hidden
        }
    </script>
</section>