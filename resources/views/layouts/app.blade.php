<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HealthCarePro') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased ">
    {{-- Header (shared on all pages) --}}
    @include('partials.header')

    {{-- All pages content goes here --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer (shared on all pages) --}}
    @include('partials.footer')

    {{-- Global JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}" defer></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/SplitText.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/TextPlugin.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/Flip.min.js"></script>




    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://unpkg.com/lottie-web@5.9.4/build/player/lottie.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <!-- google calender -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://apis.google.com/js/api.js"></script>

    <!-- clerk -->
    <script src="https://cdn.jsdelivr.net/npm/@clerk/clerk-sdk@latest/dist/clerk.browser.js"></script>


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>



</body>

</html>