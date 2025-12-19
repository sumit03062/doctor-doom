<section id="contact" class="relative w-full py-16 overflow-hidden bg-gray-50 lg:py-24">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">

        <!-- Section Header -->
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-4xl font-bold text-gray-900 md:text-5xl">
                Get in Touch <span class="text-transparent bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text">With Us</span>
            </h2>
            <p class="max-w-2xl mx-auto text-lg text-gray-600 split-desc">
                Have questions? Need assistance? We're here to help you 24/7.
            </p>
        </div>

        <div class="space-y-10 lg:grid lg:gap-12 lg:space-y-0">

            <!-- ===========================
                 CONTACT FORM (Top on Mobile, Left on Desktop)
            ------------------------------ -->
            <div class="">
                <div class="p-8 shadow-2xl lg:p-10 rounded-3xl bg-gradient-to-r from-blue-200 to-green-200">
                    <h3 class="mb-6 text-2xl font-bold text-gray-800 lg:text-3xl">Send Us a Message</h3>
                    @if(session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="justify-center space-y-6 ">
                        @csrf

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name" required placeholder="John Doe"
                                    class="w-full px-4 py-3 transition border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Age</label>
                                <input type="number" name="age" min="1" max="120" placeholder="e.g. 35"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required placeholder="john@example.com"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" name="phone" required placeholder="+91 98000 00000"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Your City / Location</label>
                                <input type="text" name="location" placeholder="e.g. New Delhi, India"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Reason for Contact <span class="text-red-500">*</span></label>
                                <select name="reason" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="" disabled selected>Select a reason</option>
                                    <option value="appointment">Book an Appointment</option>
                                    <option value="inquiry">General Inquiry</option>
                                    <option value="feedback">Feedback or Complaint</option>
                                    <option value="emergency">Emergency Assistance</option>
                                    <option value="insurance">Insurance & Billing</option>
                                    <option value="career">Career Opportunities</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>


                        <button type="submit"
                            class="tilt-btnn relative p-4 text-lg font-bold text-white transition transform rounded-md shadow-lg bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-700 hover:to-emerald-700 hover:shadow-xl hover:-translate-y-1 left-[46%]">
                            Submit
                        </button>

                    </form>
                </div>
            </div>

            <!-- ===========================
                 MAP + ADDRESS (Bottom on Mobile, Right on Desktop)
            ------------------------------ -->
            <div class="grid items-center justify-center gap-12 md:flex">
                <!-- Google Map -->
                <div class="overflow-hidden border-4 border-white shadow-2xl rounded-3xl h-96 lg:h-full min-h-96">
                    <iframe
                        class="w-full h-full"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.756928397568!2d77.138866614957!3d28.645258182415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03e9c2c96e0b%3A0x91e94e7e7d5e5e5e!2sKirti%20Nagar%2C%20New%20Delhi%2C%20Delhi%20110015!5e0!3m2!1sen!2sin!4v1700000000000"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Address & Contact Info -->
                <div class="p-6 mt-8 text-center bg-white shadow-xl rounded-3xl lg:mt-10">
                    <h4 class="mb-5 text-2xl font-bold text-gray-800">Visit Our Clinic</h4>
                    <div class="space-y-4 text-gray-700">
                        <div class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">Kirti Nagar, New Delhi - 110015</span>
                        </div>
                        <div class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            <span class="font-medium">+91 98000 00000</span>
                        </div>
                        <div class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <span class="font-medium">info@healthcarepro.com</span>
                        </div>
                        <div class="pt-4 text-sm text-gray-500">
                            Open: Mon–Sat 8:00 AM – 8:00 PM | Sunday 9:00 AM – 5:00 PM
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>