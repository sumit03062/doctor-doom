<section class="relative py-24 overflow-hidden bg-[var(--gradient-brand-light)]">

    <!-- Background Accents -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96
                bg-[var(--green-primary)] rounded-full blur-3xl opacity-20 animate-float"></div>
    <div class="absolute -bottom-24 right-1/2 translate-x-1/2 w-[28rem] h-[28rem]
                bg-[var(--blue-primary)] rounded-full blur-3xl opacity-20 animate-float delay-2000"></div>

    <div class="relative px-6 mx-auto text-center max-w-7xl">

        <!-- Section Header -->
        <div class="max-w-2xl mx-auto mb-16 animate-fade-up">
            <span class="inline-block px-4 py-1 mb-4 text-sm font-semibold rounded-full
                         text-[var(--green-dark)] bg-green-100">
                Our Values
            </span>

            <h2 class="text-4xl font-extrabold text-[var(--text-dark)]">
                Our Core <span class="text-brand">Values</span>
            </h2>

            <p class="mt-4 text-lg text-[var(--text-muted)]">
                The principles that guide our platform, our people,
                and every healthcare experience we deliver.
            </p>
        </div>

        @php
            $values = [
                [
                    'title' => 'Care First',
                    'description' => 'Compassion and patient well-being remain at the heart of everything we build.',
                    'icon' => '
                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06
                                 a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23
                                 l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                    ',
                ],
                [
                    'title' => 'Transparency',
                    'description' => 'Honest communication, clear processes, and complete trust at every step.',
                    'icon' => '
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    ',
                ],
                [
                    'title' => 'Innovation',
                    'description' => 'We leverage technology to simplify healthcare and continuously improve outcomes.',
                    'icon' => '
                        <path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/>
                    ',
                ],
                [
                    'title' => 'Trust & Ethics',
                    'description' => 'Privacy, security, and ethical responsibility guide everything we do.',
                    'icon' => '
                        <path d="M12 2l7 4v6c0 5-3.5 9-7 10
                                 -3.5-1-7-5-7-10V6l7-4z"/>
                    ',
                ],
            ];
        @endphp

        <!-- Values Grid -->
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">

            @foreach ($values as $index => $value)
                <div class="p-8 transition-all duration-300 shadow-xl hover:scale-105 hover:-translate-y-2 hover:shadow-2xl rounded-3xl bg-white/70 backdrop-blur animate-fade-up"
                     style="--delay: {{ $index * 0.2 }}s">

                    <div class="flex items-center justify-center mx-auto mb-6 text-white w-14 h-14 rounded-xl bg-brand">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            {!! $value['icon'] !!}
                        </svg>
                    </div>

                    <h4 class="mb-2 text-xl font-semibold text-[var(--text-dark)]">
                        {{ $value['title'] }}
                    </h4>

                    <p class="text-[var(--text-muted)]">
                        {{ $value['description'] }}
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</section>
