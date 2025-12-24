<section class="relative overflow-hidden py-28 bg-brand-light">
    <!-- Decorative Shapes -->
    <div class="absolute bg-green-200 rounded-full -top-32 -left-32 w-96 h-96 blur-3xl opacity-30"></div>
    <div class="absolute bg-blue-200 rounded-full -bottom-32 -right-32 w-96 h-96 blur-3xl opacity-30"></div>

    <div class="relative px-6 mx-auto max-w-7xl">
        <div class="grid items-center gap-16 lg:grid-cols-2">

            <!-- Content -->
            <div data-aos="fade-right">
                <span class="inline-block px-4 py-1 mb-4 text-sm font-semibold text-white rounded-full text-brand">
                    Digital Healthcare Platform
                </span>

                <h2 class="mb-6 text-4xl font-bold leading-tight md:text-5xl text-dark">
                    Your Health Is Our <br>
                    <span class="text-brand">Top Priority</span>
                </h2>

                <p class="max-w-xl mb-8 text-lg text-muted">
                    Connect with trusted doctors, book appointments instantly,
                    and manage your healthcare journey effortlessly.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="/"
                       class="flex items-center gap-2 px-10 py-4 font-semibold transition shadow-lg bg-brand-dark btn1 rounded-xl hover:shadow-xl">
                        <i data-lucide="calendar-check" class="w-5 h-5"></i>
                        Book Appointment
                    </a>

                    <a href="{{ route('doctors.page') }}"
                       class="flex items-center gap-2 px-10 py-4 font-semibold transition shadow-lg bg-brand-dark btn1 rounded-xl hover:shadow-xl">
                        <i data-lucide="stethoscope" class="w-5 h-5"></i>
                        Find Doctors
                    </a>
                </div>
            </div>

            <!-- Feature Cards -->
            <div class="grid gap-6 sm:grid-cols-2" data-aos="fade-left">
                @php
                    $features = [
                        ['icon' => 'stethoscope', 'title' => 'Verified Doctors', 'desc' => 'Consult experienced specialists'],
                        ['icon' => 'calendar', 'title' => 'Easy Booking', 'desc' => 'Appointments in seconds'],
                        ['icon' => 'shield-check', 'title' => 'Secure Records', 'desc' => 'Encrypted medical data'],
                        ['icon' => 'message-circle', 'title' => 'Follow-ups', 'desc' => 'Post consultation care'],
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="p-6 transition bg-white shadow-lg rounded-3xl hover:shadow-xl">
                        <i data-lucide="{{ $feature['icon'] }}" class="w-8 h-8 mb-3 text-blue-500"></i>
                        <h4 class="mb-1 text-lg font-semibold text-dark">
                            {{ $feature['title'] }}
                        </h4>
                        <p class="text-sm text-muted">
                            {{ $feature['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
