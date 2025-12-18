<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm backdrop-blur-md">
    <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo Section -->
            <div class="flex items-center space-x-3">
                <a href="/">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full shadow-lg bg-brand">
                        <i data-lucide="stethoscope" class="text-white"></i>
                    </div>
                </a>

                <div>
                    <a href="/">
                        <h1 class="text-xl font-bold text-brand">
                            HealthCarePro
                        </h1>
                        <p class="text-xs text-muted">Board Certified Doctors</p>
                    </a>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="items-center hidden p-4 space-x-8 rounded-full md:flex bg-brand">
                <a href="/" class="text-white transition hover:text-green-200">Home</a>
                <a href="#about" class="text-white transition hover:text-green-200">About</a>
                <a href="{{ route('doctors.page') }}" class="text-white transition hover:text-green-200">Doctors</a>
                <a href="#services" class="text-white transition hover:text-green-200">Services</a>
                <a href="#blogs" class="text-white transition hover:text-green-200">Blogs</a>
                <a href="#contact" class="text-white transition hover:text-green-200">Contact</a>
            </div>

            <!-- Right Section -->
            <div class="items-center hidden space-x-6 lg:flex">

                <!-- Phone -->
                <div class="flex items-center text-gray-600 rounded-full">
                    <dotlottie-wc
                        src="https://lottie.host/56b2b686-16a7-4a6b-9238-1366b5773276/LaqeaMRPrS.lottie"
                        style="width:50px;height:50px" autoplay loop></dotlottie-wc>
                    <span class="ml-2 text-sm font-medium hover:text-green-600">+91 9800000000</span>
                </div>

                <!-- Appointment Icon -->
                <button type="button"
                    class="relative p-1 text-gray-400 rounded-full hover:text-green-500 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        aria-hidden="true" class="w-6 h-6">
                        <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <!-- Auth Section -->
                @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm rounded-full btn-primary">Sign In</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm rounded-full btn-secondary">Sign Up</a>
                @endguest

                @auth
                <!-- Profile dropdown -->
                <div class="relative">
                    @auth
                    @if(Auth::user()->role === 'doctor')
                    <a href="{{ route('doctor.dashboard') }}" class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e"
                            class="w-10 h-10 rounded-full" alt="Profile">
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e"
                            class="w-10 h-10 rounded-full" alt="Profile">
                    </a>
                    @endif
                    @endauth
                </div>
                @endauth

            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileBtn" class="p-2 rounded-lg md:hidden hover:bg-gray-100">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden py-4 border-t border-gray-200 md:hidden">
            <div class="flex flex-col space-y-4">

                <a href="#home" class="text-gray-700 hover:text-green-600">Home</a>
                <a href="#about" class="text-gray-700 hover:text-green-600">About</a>
                <a href="{{ route('doctors.page') }}" class="text-gray-700 hover:text-green-600">Doctors</a>
                <a href="#services" class="text-gray-700 hover:text-green-600">Services</a>
                <a href="#blogs" class="text-gray-700 hover:text-green-600">Blogs</a>
                <a href="#contact" class="text-gray-700 hover:text-green-600">Contact</a>

                <!-- Auth Section Mobile -->
                @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-center text-white bg-blue-500 rounded-full">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm text-center text-white bg-green-600 rounded-full">
                    Sign Up
                </a>
                @endguest

                @auth
                <div class="flex items-center space-x-2">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" class="w-10 h-10 rounded-full">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 mt-2 text-red-500 bg-red-100 rounded-full">
                        Logout
                    </button>
                </form>
                @endauth

                <!-- Mobile Appointment -->
                <a href="">
                    <button class="px-6 py-2.5 bg-brand text-white rounded-full font-medium shadow-lg">
                        Book Appointment
                    </button>
                </a>
            </div>
        </div>

    </div>
</nav>


