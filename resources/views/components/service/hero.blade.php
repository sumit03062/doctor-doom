<section class="relative overflow-hidden py-28 bg-brand-light">
    <!-- Decorative Gradient Orbs (Brand Colors Only) -->
    <div class="absolute bg-green-200 rounded-full -top-32 -left-32 w-96 h-96 blur-3xl opacity-30"></div>
    <div class="absolute bg-blue-200 rounded-full -bottom-32 -right-32 w-96 h-96 blur-3xl opacity-30"></div>

    <div class="relative px-6 mx-auto text-center max-w-7xl">
        <!-- Badge -->
        <span class="inline-flex items-center gap-2 px-4 py-1 mb-6 text-sm font-semibold text-white rounded-full bg-brand">
            <i data-lucide="heart-pulse" class="w-4 h-4"></i>
            Trusted Healthcare Platform
        </span>

        <!-- Heading -->
        <h1 class="mb-6 text-4xl font-bold leading-tight md:text-5xl lg:text-6xl text-dark">
            Healthcare Services You Can <br class="hidden md:block">
            <span class="text-brand">Trust & Rely On</span>
        </h1>

        <!-- Description -->
        <p class="max-w-3xl mx-auto text-lg md:text-xl text-muted">
            MyHealthCarePro connects patients with verified doctors,
            modern clinics, and secure healthcare services — all in one
            smart digital platform.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mt-12">
            <a href="#appointments"
               class="flex items-center gap-2 px-10 py-4 font-semibold transition shadow-lg bg-brand-dark rounded-xl hover:shadow-xl">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                Book Appointment
            </a>

            <a href="{{ route('doctors.page') }}"
               class="flex items-center gap-2 px-10 py-4 font-semibold transition shadow-lg bg-brand-dark rounded-xl hover:shadow-xl">
                <i data-lucide="stethoscope" class="w-5 h-5"></i>
                Find Doctors
            </a>
        </div>

        <!-- Trust Indicators -->
        <div class="grid gap-6 mt-16 sm:grid-cols-3">
            <div class="p-6 bg-white shadow rounded-2xl">
                <i data-lucide="user-check" class="w-6 h-6 mx-auto mb-3 text-blue-500"></i>
                <p class="font-semibold text-dark">Verified Doctors</p>
                <p class="text-sm text-muted">Qualified & experienced</p>
            </div>

            <div class="p-6 bg-white shadow rounded-2xl">
                <i data-lucide="shield-check" class="w-6 h-6 mx-auto mb-3 text-green-500"></i>
                <p class="font-semibold text-dark">Secure Platform</p>
                <p class="text-sm text-muted">Data privacy protected</p>
            </div>

            <div class="p-6 bg-white shadow rounded-2xl">
                <i data-lucide="clock" class="w-6 h-6 mx-auto mb-3 text-blue-500"></i>
                <p class="font-semibold text-dark">Quick Booking</p>
                <p class="text-sm text-muted">No long waiting time</p>
            </div>
        </div>
    </div>
</section>
