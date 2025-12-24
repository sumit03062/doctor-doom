<section class="relative w-full py-20 bg-white">
    <div class="px-6 mx-auto max-w-7xl">

        <!-- Section Heading -->
        <div class="mb-16 text-center">
            <h2 class="text-4xl font-bold text-dark">
                Meet Our <span class="text-brand">Expert Doctors</span>
            </h2>
            <p class="max-w-2xl mx-auto mt-4 text-muted">
                Browse verified doctors, view profiles, and book appointments
                with confidence.
            </p>
        </div>

        <!-- Doctors Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($doctors as $doctor)
            <div class="relative p-6 transition bg-white shadow-lg rounded-3xl hover:shadow-2xl">

                <!-- Doctor Header -->
                <div class="flex items-center gap-4 mb-6">
                    <img
                        src="{{ $doctor->user->profile_photo_url ?? asset('default-doctor.png') }}"
                        alt="{{ $doctor->user->name }}"
                        class="object-cover w-16 h-16 border-2 rounded-full border-green-primary">

                    <div>
                        <h3 class="text-lg font-bold text-dark">
                            Dr. {{ $doctor->user->name }}
                        </h3>
                        <p class="text-sm text-muted">
                            {{ $doctor->specialization }}
                        </p>
                    </div>
                </div>

                <!-- Details -->
                <div class="space-y-2 text-sm text-muted">
                    <p class="flex items-center gap-2">
                        <i data-lucide="building" class="w-4 h-4"></i>
                        {{ $doctor->clinic_name }}
                    </p>
                    <p class="flex items-center gap-2">
                        <i data-lucide="wallet" class="w-4 h-4"></i>
                        ₹{{ $doctor->fees }} Consultation Fee
                    </p>
                </div>

                <!-- Action -->
                <div class="mt-6">
                    <button
                        class="inline-flex items-center gap-2 px-5 py-2 text-sm font-semibold rounded-full btn-primary"
                        onclick="openDoctorModal('{{ $doctor->id }}')">
                        <i data-lucide="user-search" class="w-4 h-4"></i>
                        View Profile
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div id="doctor-modal-{{ $doctor->id }}"
                class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50">

                <div class="relative w-full max-w-lg p-6 mx-4 bg-white shadow-xl rounded-2xl max-h-[90vh] overflow-y-auto">

                    <!-- Close -->
                    <button
                        class="absolute top-4 right-4 text-muted hover:text-red-500"
                        onclick="closeDoctorModal('{{ $doctor->id }}')">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>

                    <!-- Modal Content -->
                    <h3 class="mb-4 text-2xl font-bold text-dark">
                        Dr. {{ $doctor->user->name }}
                    </h3>

                    <div class="space-y-2 text-sm text-muted">
                        <p><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
                        <p><strong>Experience:</strong> {{ $doctor->experience ?? 0 }} years</p>
                        <p><strong>Qualification:</strong> {{ $doctor->qualification ?? '-' }}</p>
                        <p><strong>Clinic:</strong> {{ $doctor->clinic_name }}</p>
                        <p><strong>Address:</strong> {{ $doctor->clinic_address ?? 'N/A' }}</p>
                        <p><strong>Fees:</strong> ₹{{ $doctor->fees }}</p>
                        <p><strong>About:</strong> {{ $doctor->bio ?? 'N/A' }}</p>
                    </div>

                    <!-- CTA -->
                    <div class="mt-8 text-center">
                        <a href="/"
                           class="inline-flex items-center gap-2 px-8 py-3 font-semibold rounded-full btn-secondary">
                            <i data-lucide="calendar-check" class="w-5 h-5"></i>
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

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
