<section class="relative overflow-hidden py-28 bg-brand-light">
    <!-- Decorative Brand Shapes -->
    <div class="absolute bg-green-200 rounded-full -top-32 -left-32 w-96 h-96 blur-3xl opacity-30"></div>
    <div class="absolute bg-blue-200 rounded-full -bottom-32 -right-32 w-96 h-96 blur-3xl opacity-30"></div>

    <div class="relative max-w-6xl px-6 mx-auto text-center">
        <!-- Badge -->
        <span class="inline-flex items-center gap-2 px-4 py-1 mb-6 text-sm font-semibold text-white rounded-full bg-brand">
            <i data-lucide="users" class="w-4 h-4"></i>
            Trusted Medical Professionals
        </span>

        <!-- Heading -->
        <h1 class="mb-6 text-4xl font-extrabold md:text-5xl text-dark">
            Meet Our <span class="text-brand">Doctors</span>
        </h1>

        <!-- Description -->
        <p class="max-w-3xl mx-auto text-lg md:text-xl text-muted">
            Our team of experienced and verified doctors is committed to
            providing compassionate, reliable, and high-quality healthcare.
            Browse profiles and book appointments with confidence.
        </p>

        <!-- Quick Actions -->
        <div class="flex flex-wrap justify-center gap-4 mt-10">
            <a href="{{ route('doctors.page') }}"
               class="inline-flex items-center gap-2 px-8 py-3 font-semibold rounded-xl btn-primary">
                <i data-lucide="search" class="w-5 h-5"></i>
                Find Doctors
            </a>

            <a href="/"
               class="inline-flex items-center gap-2 px-8 py-3 font-semibold rounded-xl btn-secondary">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                Book Appointment
            </a>
        </div>
    </div>
</section>
