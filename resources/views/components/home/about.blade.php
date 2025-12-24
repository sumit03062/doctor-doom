<section class="relative w-full min-h-screen overflow-hidden bg-white md:py-20 lg:py-28 py-9">
  <div class="px-6 mx-auto max-w-7xl lg:px-8">
    
    <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-20">
      
      <!-- Left: Images Collage + Trust Badges -->
      <div class="relative order-2 lg:order-1">
        <!-- Main Image -->
        <div class="relative hidden overflow-hidden shadow-2xl rounded-3xl md:grid">
          <img src="https://images.pexels.com/photos/287237/pexels-photo-287237.jpeg" alt="Our Hospital" 
               class="w-full h-[500px] object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        </div>
      </div>

      <!-- Right: Content -->
      <div class="order-1 space-y-8 sm:mt-8 lg:order-2">
        <!-- Section Tag -->
        <h3 class="inline-flex items-center gap-3 font-semibold text-teal-600 md:text-2xl">
          <span class="w-12 h-0.5 bg-teal-600"></span>
          ABOUT OUR HOSPITAL
        </h3>

        <!-- Main Heading -->
        <h2 class="text-4xl font-bold leading-tight text-gray-900 lg:text-5xl">
          Healing with <span class="text-transparent bg-clip-text text-brand ">Care & Excellence</span> Since 1999
        </h2>

        <!-- Description -->
        <p class="text-lg leading-relaxed text-gray-600 split-desc">
          We are a 500+ bed NABH-accredited super-specialty hospital committed to delivering world-class healthcare with compassion, integrity, and cutting-edge medical technology.
        </p>
        <p class="text-lg leading-relaxed text-gray-600 split-desc">
          From life-saving emergency care to planned surgeries and preventive health checkups — our team of 200+ expert doctors and 1000+ dedicated staff ensure every patient receives personalized attention and the best possible outcomes.
        </p>

        <!-- Highlights Grid -->
        <div class="grid grid-cols-1 gap-6 mt-10 sm:grid-cols-2">
          <div class="flex gap-4">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl">
              <i data-lucide="heart-handshake" class="text-green-600 w-7 h-7"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900">Patient-First Approach</h4>
              <p class="text-sm text-gray-600">Your well-being is our only priority</p>
            </div>
          </div>

          <div class="flex gap-4">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl">
              <i data-lucide="microscope" class="text-blue-600 w-7 h-7"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900">Latest Technology</h4>
              <p class="text-sm text-gray-600">Advanced diagnostics & robotic surgery</p>
            </div>
          </div>

          <div class="flex gap-4">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-xl">
              <i data-lucide="shield-check" class="w-7 h-7 text-emerald-600"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900">100% Safe & Hygienic</h4>
              <p class="text-sm text-gray-600">Strict infection control protocols</p>
            </div>
          </div>

          <div class="flex gap-4">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-xl">
              <i data-lucide="hand-coins" class="text-indigo-600 w-7 h-7"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900">Transparent Pricing</h4>
              <p class="text-sm text-gray-600">No hidden charges, cashless facility</p>
            </div>
          </div>
        </div>

        <!-- CTA Buttons -->
        <div class="relative flex flex-col gap-5 pt-6 sm:flex-row sm:left-[35%]">
          <a href="about-us.php" class="px-8 py-4 font-bold text-white transition transform rounded-full shadow-lg bg-brand-dark hover:shadow-xl hover:scale-105">
            Know More About Us
          </a>
         
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Lucide Icons (if not already loaded) -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script>
  lucide.createIcons();
</script>