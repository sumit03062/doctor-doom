<section id="appointment" class="relative w-full py-16 overflow-hidden bg-gradient-to-br from-blue-50 via-cyan-50 to-emerald-50 lg:py-24">
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>

    <div class="relative px-6 mx-auto max-w-7xl lg:px-8">
        <!-- Header -->
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 md:text-5xl lg:text-6xl">
                Book Your <span class="text-transparent bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text">Appointment</span>
            </h2>
            <p class="max-w-2xl mx-auto text-lg text-gray-600 split-desc lg:text-xl">
                Get expert care from our specialist doctors. Same-day appointments available.
            </p>
        </div>

        <div class="grid items-start gap-10 lg:grid-cols-2 lg:gap-16">

            <!-- ===========================
                 MAIN APPOINTMENT FORM (Left on Desktop, Top on Mobile)
            ------------------------------ -->
            <div class="order-2 lg:order-1">
                <div class="relative overflow-hidden bg-white border shadow-2xl rounded-3xl backdrop-blur-xl bg-opacity-95 border-white/20">
                    <!-- Decorative Top Bar -->
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 to-emerald-500 rounded-t-3xl"></div>

                    <div class="p-8 lg:p-10">
                        <h3 class="mb-8 text-3xl font-bold text-gray-800">
                            Schedule Your Visit
                        </h3>
                        @auth
                        <form action="{{ route('appointment.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Full Name -->
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="Enter your full name"
                                    class="w-full px-5 py-4 text-base transition-all border-2 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('full_name') border-red-500 @enderror">
                                @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email & Phone -->
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Email Address <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                                        class="w-full px-5 py-4 transition-all border-2 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('email') border-red-500 @enderror">
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="+91 98000 00000"
                                        class="w-full px-5 py-4 transition-all border-2 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('phone') border-red-500 @enderror">
                                    @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Age and Gender -->
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Age <span class="text-red-500">*</span></label>
                                    <input type="number" name="age" value="{{ old('age') }}" required placeholder="Your Age" min="1" max="120"
                                        class="w-full px-5 py-4 transition-all border-2 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('age') border-red-500 @enderror">
                                    @error('age')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Gender <span class="text-red-500">*</span></label>
                                    <select name="gender" required class="w-full px-5 py-4 text-base transition-all border-2 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('gender') border-red-500 @enderror">
                                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Choose Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Department -->
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Select Department <span class="text-red-500">*</span></label>
                                <select name="department" required class="w-full px-5 py-4 text-base transition-all border-2 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('department') border-red-500 @enderror">
                                    <option value="" disabled {{ old('department') ? '' : 'selected' }}>Choose department</option>
                                    <option value="general" {{ old('department') == 'general' ? 'selected' : '' }}>General Medicine</option>
                                    <option value="cardiology" {{ old('department') == 'cardiology' ? 'selected' : '' }}>Cardiology</option>
                                    <option value="dermatology" {{ old('department') == 'dermatology' ? 'selected' : '' }}>Dermatology & Skin Care</option>
                                    <option value="neurology" {{ old('department') == 'neurology' ? 'selected' : '' }}>Neurology</option>
                                    <option value="orthopedics" {{ old('department') == 'orthopedics' ? 'selected' : '' }}>Orthopedics & Joint Replacement</option>
                                    <option value="pediatrics" {{ old('department') == 'pediatrics' ? 'selected' : '' }}>Pediatrics</option>
                                    <option value="dental" {{ old('department') == 'dental' ? 'selected' : '' }}>Dental Care</option>
                                    <option value="eye" {{ old('department') == 'eye' ? 'selected' : '' }}>Eye Care (Ophthalmology)</option>
                                    <option value="ent" {{ old('department') == 'ent' ? 'selected' : '' }}>ENT (Ear, Nose, Throat)</option>
                                    <option value="gynecology" {{ old('department') == 'gynecology' ? 'selected' : '' }}>Gynecology</option>
                                </select>
                                @error('department')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Doctor Selection -->
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Preferred Doctor (Optional)</label>
                                <select name="doctor_id" class="w-full px-5 py-4 border-2 rounded-2xl">
                                    <option value="">Any available doctor</option>

                                    @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">
                                        Dr. {{ $doctor->name }}
                                        ({{ $doctor->doctorProfile->specialization ?? 'General' }})
                                    </option>


                                    @endforeach
                                </select>

                            </div>

                            <!-- Date & Time -->
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Preferred Date <span class="text-red-500">*</span></label>
                                    <input type="date" name="appointment_date" value="{{ old('appointment_date') }}" required min="{{ date('Y-m-d') }}"
                                        class="w-full px-5 py-4 transition-all border-2 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('appointment_date') border-red-500 @enderror">
                                    @error('appointment_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Preferred Time <span class="text-red-500">*</span></label>
                                    <select name="appointment_time" required class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                        <option value="">Select Time</option>
                                        @php
                                        $times = ['09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00'];
                                        @endphp
                                        @foreach($times as $time)
                                        <option value="{{ $time }}" {{ old('appointment_time') == $time ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('appointment_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Symptoms / Notes -->
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Symptoms or Special Requests</label>
                                <textarea name="message" rows="4" placeholder="Describe your symptoms or any special requirements..."
                                    class="w-full px-5 py-4 transition-all border-2 resize-none rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" id="appointmentSubmitBtn"
                                    class="flex items-center justify-center w-full gap-3 py-5 text-xl font-bold text-white transition-all transform shadow-xl tilt-btn bg-gradient-to-r from-blue-600 to-emerald-600 rounded-2xl hover:from-blue-700 hover:to-emerald-700 active:scale-95 hover:shadow-2xl hover:-translate-y-1 group">
                                    <span>Book Appointment Now</span>
                                    <svg class="w-6 h-6 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </button>
                            </div>

                            <p class="mt-4 text-xs text-center text-gray-500">
                                We will confirm your appointment via SMS & Email within 10 minutes.
                            </p>

                            @if ($errors->any())
                            <div class="text-red-600">
                                @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif

                        </form>

                        @endauth
                        @guest
                        <p>Please <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> to book an appointment.</p>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- ===========================
                 RIGHT SIDE - INFO CARD (Desktop Only or Below on Mobile)
            ------------------------------ -->
            <div class="order-1 lg:order-2">
                <div class="space-y-8">
                    <!-- Quick Info Cards -->
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-1">
                        <div class="p-6 text-center bg-white border border-blue-100 shadow-xl rounded-3xl">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800">Open 7 Days</h4>
                            <p class="mt-2 text-gray-600">24 Hours Services</p>
                        </div>

                        <div class="p-6 text-center bg-white border shadow-xl rounded-3xl border-emerald-100">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-emerald-100">
                                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800">Instant Confirmation</h4>
                            <p class="mt-2 text-gray-600">Get confirmed slot instantly via SMS & WhatsApp</p>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="p-8 text-center text-white shadow-2xl bg-gradient-to-r from-red-500 to-pink-600 rounded-3xl">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 7a1 1 0 012 0v4a1 1 0 11-2 0V7zm1 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <h4 class="text-2xl font-bold">24x7 Emergency</h4>
                        <p class="mt-3 text-3xl font-extrabold">+91 98000 00000</p>
                        <p class="mt-2 opacity-90">Call now for immediate assistance</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>