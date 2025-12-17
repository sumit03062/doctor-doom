@extends('layouts.app')

@section('content')
<section class="w-full py-16 overflow-hidden md:py-20 lg:py-28 bg-gradient-to-br from-teal-50 via-blue-50 to-indigo-100">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <h1 class="mb-10 text-4xl font-extrabold text-center text-gray-900 md:text-5xl">
            My Profile, <span class="text-transparent bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text">{{ Auth::user()->name }}!</span>
        </h1>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <!-- LEFT: Profile Card with Upload -->
            <div class="lg:col-span-1">
                <div class="overflow-hidden bg-white border border-gray-100 shadow-xl rounded-3xl">
                    <div class="h-32 bg-gradient-to-r from-green-500 to-blue-600"></div>

                    <div class="relative px-8 pb-10 -mt-20 text-center">
                        <div class="relative inline-block">
                            <!-- Current Profile Picture -->
                            <img id="profile-preview"
                                src="{{ $user->profile_photo_url }}"
                                alt="Profile Picture"
                                class="object-cover w-40 h-40 mx-auto border-8 border-white rounded-full shadow-2xl">

                            <!-- Camera Icon Overlay -->
                            <label for="profile-photo" class="absolute cursor-pointer bottom-2 right-2">
                                <div class="flex items-center justify-center w-12 h-12 text-white transition-all duration-300 transform rounded-full shadow-lg bg-gradient-to-r from-green-500 to-blue-600 hover:shadow-2xl hover:scale-110">
                                    <i data-lucide="camera" class="w-6 h-6"></i>
                                </div>
                            </label>
                        </div>

                        <h2 class="mt-6 text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-500">Patient ID: #MC{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>

                        <!-- Upload Form -->
                        <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" id="photo-upload-form">
                            @csrf
                            @method('PATCH')
                            <input type="file" name="profile_photo" id="profile-photo" class="hidden" accept="image/*" onchange="previewAndUpload(event)">
                        </form>

                        <script>
                            function previewAndUpload(event) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('profile-preview').src = e.target.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);

                                // Automatically submit the form
                                document.getElementById('photo-upload-form').submit();
                            }
                        </script>


                        <div class="mt-8 space-y-5 text-left">
                            <div class="flex items-center gap-4">
                                <i data-lucide="cake" class="w-6 h-6 text-green-600"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Age</p>
                                    <p class="font-semibold text-gray-900"><?= $user->age ?? 'Not set' ?> Years</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <i data-lucide="user" class="w-6 h-6 text-blue-600"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Gender</p>
                                    <p class="font-semibold text-gray-900"><?= ucfirst($user->gender ?? 'Not set') ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <i data-lucide="phone" class="w-6 h-6 text-purple-600"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-semibold text-gray-900"><?= $user->phone ?? 'Not set' ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <i data-lucide="mail" class="w-6 h-6 text-pink-600"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-semibold text-gray-900 break-all"><?= htmlspecialchars($user->email) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Profile Edit Forms -->
            <div class="space-y-8 lg:col-span-2">

                <!-- Update Profile Information -->
                <div class="p-8 bg-white border border-gray-100 shadow-xl rounded-3xl">
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-gray-800">
                        <i data-lucide="user-cog" class="w-8 h-8 text-green-600"></i>
                        Update Profile Information
                    </h2>

                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full px-4 py-3 transition border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Age</label>
                                <input type="number" name="age" value="{{ old('age', $user->age) }}" min="1" max="120"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">
                                @error('age') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Gender</label>
                                <select name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                                    placeholder="+1 (555) 000-0000">
                                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                                    required>
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-8 py-3 font-semibold text-white transition-all transform shadow-lg rounded-xl bg-gradient-to-r from-green-500 to-blue-500 hover:shadow-xl hover:scale-105">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="p-8 bg-white border border-gray-100 shadow-xl rounded-3xl">
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-gray-800">
                        <i data-lucide="lock" class="w-8 h-8 text-blue-600"></i>
                        Update Password
                    </h2>
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account -->
                <div class="p-8 bg-white border border-red-100 shadow-xl rounded-3xl">
                    <h2 class="flex items-center gap-3 mb-6 text-2xl font-bold text-gray-800">
                        <i data-lucide="alert-triangle" class="w-8 h-8 text-red-600"></i>
                        Delete Account
                    </h2>
                    <p class="mb-6 text-gray-600">Permanently delete your account and all data.</p>
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>

        <!-- Floating Sign Out Button -->
        <div class="fixed z-50 bottom-8 right-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-6 py-4 font-semibold text-white transition-all transform bg-red-600 shadow-2xl rounded-2xl hover:bg-red-700 hover:scale-110">
                    <i data-lucide="log-out" class="w-6 h-6"></i>
                    Sign Out
                </button>
            </form>
        </div>

    </div>
</section>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    // Live preview when user selects new photo
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);

            // Auto-submit the form after selection
            document.getElementById('photo-upload-form').submit();
        }
    }

    // Optional: Click on image also opens file picker
    document.getElementById('profile-preview').addEventListener('click', () => {
        document.getElementById('profile-photo').click();
    });
</script>
</body>

</html>
@endsection