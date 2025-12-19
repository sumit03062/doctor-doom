{{-- Testimonials Grid Section --}}
<section class="relative py-24 text-white bg-text-dark">
    <div class="max-w-6xl px-6 mx-auto mb-16 text-center">
        <span class="text-sm tracking-wider uppercase text-green-primary">Wall of Love</span>
        <h2 class="mt-2 mb-4 text-5xl font-bold text-brand">Loved by thinkers</h2>
        <p class="text-lg text-muted">
            Here's what people are saying about us
        </p>
    </div>

    @php
        $testimonials = [
            ['name' => 'Ankit Sharma', 'handle' => '@ankit', 'role' => 'Patient', 'text' => 'HealthCarePro made booking my doctor appointment effortless. The platform is fast, secure, and reliable.', 'image' => 'https://i.pravatar.cc/150?img=1'],
            ['name' => 'Dr. Neha Verma', 'handle' => '@drneha', 'role' => 'General Physician', 'text' => 'A well-designed healthcare solution that truly understands patient needs.', 'image' => 'https://i.pravatar.cc/150?img=2'],
            ['name' => 'Rahul Mehta', 'handle' => '@rahul', 'role' => 'Patient', 'text' => 'Simple, professional, and trustworthy. Highly recommended.', 'image' => 'https://i.pravatar.cc/150?img=3'],
            ['name' => 'Priya Singh', 'handle' => '@priya', 'role' => 'Patient', 'text' => 'I love how easy it is to manage my health appointments online.', 'image' => 'https://i.pravatar.cc/150?img=4'],
            ['name' => 'Dr. Rohan Kapoor', 'handle' => '@drrohan', 'role' => 'Surgeon', 'text' => 'A reliable platform connecting doctors and patients seamlessly.', 'image' => 'https://i.pravatar.cc/150?img=5'],
            ['name' => 'Sneha Joshi', 'handle' => '@sneha', 'role' => 'Patient', 'text' => 'Amazing service and very user-friendly interface!', 'image' => 'https://i.pravatar.cc/150?img=6']
        ];
    @endphp

    <div class="grid max-w-6xl gap-8 px-6 mx-auto sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($testimonials as $testimonial)
            <div class="p-8 transition duration-300 transform shadow-xl bg-text-dark rounded-3xl hover:scale-105">
                <div class="flex items-center mb-4">
                    <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" class="w-12 h-12 mr-4 border-2 rounded-full border-green-primary">
                    <div class="text-left">
                        <h5 class="text-lg font-semibold">{{ $testimonial['name'] }}</h5>
                        <span class="text-sm text-green-primary">{{ $testimonial['handle'] }}</span>
                    </div>
                </div>
                <p class="leading-relaxed text-muted">“{{ $testimonial['text'] }}”</p>
            </div>
        @endforeach
    </div>

    {{-- Optional background heart or abstract shape --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <svg class="w-2/4 opacity-10" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M250 450C250 450 50 300 50 150C50 75 150 0 250 50C350 0 450 75 450 150C450 300 250 450 250 450Z" fill="url(#paint0_linear)"/>
            <defs>
                <linearGradient id="paint0_linear" x1="50" y1="0" x2="450" y2="450" gradientUnits="userSpaceOnUse">
                    <stop stop-color="var(--green-primary)"/>
                    <stop offset="1" stop-color="var(--blue-primary)"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
</section>
