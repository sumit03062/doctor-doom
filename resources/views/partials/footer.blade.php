<footer class="relative bg-white border-t border-gray-200 footer">
  <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-12 md:grid-cols-4">

      <!-- Brand -->
      <div class="space-y-4">
        <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-blue-600">
          HealthCarePro
        </h2>
        <p class="text-gray-600">
          Providing quality healthcare with compassion and expertise.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="space-y-2">
        <h3 class="text-lg font-semibold text-gray-900">Quick Links</h3>
        <ul class="space-y-1 text-gray-600">
          <li><a href="/" class="hover:text-green-600">Home</a></li>
          <li><a href="{{ route('about.page') }}" class="hover:text-green-600">About</a></li>
          <li><a href="{{ route('doctors.page') }}" class="hover:text-green-600">Doctors</a></li>
          <li><a href="{{ route('service.page') }}" class="hover:text-green-600">Services</a></li>
          <li><a href="#contact" class="hover:text-green-600">Contact</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="space-y-2">
        <h3 class="text-lg font-semibold text-gray-900">Contact Us</h3>
        <p class="text-gray-600">Kirti Nagar, Delhi, India</p>
        <p class="text-gray-600">+91 98000 00000</p>
        <p class="text-gray-600">info@healthcarepro.com</p>
      </div>

      <!-- Social -->
      <div class="space-y-2">
        <h3 class="text-lg font-semibold text-gray-900">Follow Us</h3>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-600 transition-colors tilt-btn hover:text-green-600">
            <i data-lucide="facebook" class="w-6 h-6"></i>
          </a>
          <a href="#" class="text-gray-600 transition-colors tilt-btn hover:text-green-600">
            <i data-lucide="twitter" class="w-6 h-6"></i>
          </a>
          <a href="#" class="text-gray-600 transition-colors tilt-btn hover:text-green-600">
            <i data-lucide="instagram" class="w-6 h-6"></i>
          </a>
          <a href="#" class="text-gray-600 transition-colors tilt-btn hover:text-green-600">
            <i data-lucide="linkedin" class="w-6 h-6"></i>
          </a>
        </div>
      </div>

    </div>

    <div class="mt-12 text-sm text-center text-gray-500">
      © {{ date('Y') }} HealthCarePro. All rights reserved.
    </div>
  </div>
</footer>