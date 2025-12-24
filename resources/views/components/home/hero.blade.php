<?php
$slides = [
  [
    "img"       => "https://images.pexels.com/photos/8376277/pexels-photo-8376277.jpeg",
    "title"     => "Compassionate Care",
    "highlight" => "Advanced Healthcare",
    "desc"      => "Experience world-class medical support with modern technology, personalized treatment, and a patient-first approach designed to restore your health and confidence.",
    "icon1"     => "stethoscope",
    "stat1"     => "10+ Years",
    "text1"     => "Medical Excellence",
    "icon2"     => "heart-pulse",
    "stat2"     => "12,000+",
    "text2"     => "Health Recoveries",
    "icon3"     => "clock",
    "stat3"     => "24/7",
    "text3"     => "Support"
  ],
  [
    "img"       => "https://images.pexels.com/photos/6129507/pexels-photo-6129507.jpeg",
    "title"     => "Specialized Treatment",
    "highlight" => "Expert Doctors",
    "desc"      => "Our team of certified specialists ensures accurate diagnosis, effective treatments, and reliable medical guidance for every stage of your health journey.",
    "icon1"     => "activity",
    "stat1"     => "15+ Years",
    "text1"     => "Advanced Diagnosis",
    "icon2"     => "user-check",
    "stat2"     => "20,000+",
    "text2"     => "Patients Trusted",
    "icon3"     => "calendar-check",
    "stat3"     => "24/7",
    "text3"     => "Doctor Access"
  ],
  [
    "img"       => "https://images.pexels.com/photos/8442105/pexels-photo-8442105.jpeg",
    "title"     => "Modern Facilities",
    "highlight" => "Cutting-Edge Technology",
    "desc"      => "We use the latest medical equipment and advanced diagnostic tools that bring precision, safety, and unmatched treatment quality to our patients.",
    "icon1"     => "microscope",
    "stat1"     => "8+ Years",
    "text1"     => "Research-Backed",
    "icon2"     => "scan",
    "stat2"     => "9,500+",
    "text2"     => "Precision Scans",
    "icon3"     => "timer-reset",
    "stat3"     => "Same Day",
    "text3"     => "Reports"
  ],
  [
    "img"       => "https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=800",
    "title"     => "Your Trusted Partner",
    "highlight" => "Complete Wellness",
    "desc"      => "From preventive care to long-term health management, we provide personalized wellness plans ensuring a healthier life for you and your family.",
    "icon1"     => "heart-handshake",
    "stat1"     => "12+ Years",
    "text1"     => "Wellness Care",
    "icon2"     => "users-round",
    "stat2"     => "15,000+",
    "text2"     => "Families Served",
    "icon3"     => "clock",
    "stat3"     => "24/7",
    "text3"     => "Availability"
  ]
];
?>
<section id="home" class="relative w-full min-h-screen overflow-hidden py-9 bg-gradient-to-br from-teal-50 via-blue-50 to-indigo-100 md:py-20 lg:py-28 ">

  <div class="relative z-10 px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-24">

    <div class="flex flex-col-reverse md:gap-12 lg:grid lg:grid-cols-2 lg:items-center">

      <!-- LEFT TEXT -->
      <div class="relative lg:h-[480px] md:space-y-6 h-[500px]">

        <?php foreach ($slides as $index => $s): ?>
          <div class="text-content absolute inset-0 transition-opacity duration-700 <?= $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' ?>">

            <!-- Section Title -->
            <h2 class="text-2xl font-bold text-gray-800 sm:text-3xl md:text-4xl">
              <?= htmlspecialchars($s['title']) ?>
            </h2>

            <!-- Highlight -->
            <h1 class="mt-2 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl md:text-5xl">
              Exceptional Care, <span class="text-transparent text-brand bg-clip-text"><?= htmlspecialchars($s['highlight']) ?></span>
            </h1>

            <!-- Description -->
            <p class="mt-4 text-base leading-relaxed text-gray-600 split-desc sm:text-lg md:text-lg">
              <?= htmlspecialchars($s['desc']) ?>
            </p>

            <!-- Buttons -->
            <div class="flex flex-col gap-4 mt-5 sm:flex-row md:8">
              <a href="#appointment"
                class="px-8 py-4 font-semibold text-center rounded-full shadow-lg tilt-btn bg-brand-dark">
                Book Appointment
              </a>

              <a href="about.php"
                class="px-8 py-4 font-semibold text-center rounded-full shadow-lg tilt-btn bg-brand-dark">
                Know More
              </a>
            </div>


            <!-- Stats -->
            <div class="grid grid-cols-3 gap-3 mt-5 md:mt-10 md:gap-6 sm:grid-cols-3">

              <div class="text-center">
                <div class="inline-flex items-center justify-center w-10 h-10 mx-auto mb-2 bg-green-100 md:w-16 md:h-16 rounded-xl">
                  <i data-lucide="<?= $s['icon1'] ?>" class="w-8 h-8 text-green-600"></i>
                </div>
                <div class="font-bold text-gray-900 text-l sm:text-2xl"><?= $s['stat1'] ?></div>
                <div class="text-sm text-gray-600"><?= $s['text1'] ?></div>
              </div>

              <div class="text-center">
                <div class="inline-flex items-center justify-center w-10 h-10 mx-auto mb-2 bg-blue-100 rounded-xl md:w-16 md:h-16">
                  <i data-lucide="<?= $s['icon2'] ?>" class="w-8 h-8 text-blue-600"></i>
                </div>
                <div class="font-bold text-gray-900 text-l sm:text-2xl"><?= $s['stat2'] ?></div>
                <div class="text-sm text-gray-600"><?= $s['text2'] ?></div>
              </div>

              <div class="text-center">
                <div class="inline-flex items-center justify-center w-10 h-10 mx-auto mb-2 bg-green-50 rounded-xl md:w-16 md:h-16">
                  <i data-lucide="<?= $s['icon3'] ?>" class="w-8 h-8 text-green-600"></i>
                </div>
                <div class="font-bold text-gray-900 text-l sm:text-2xl"><?= $s['stat3'] ?></div>
                <div class="text-sm text-gray-600"><?= $s['text3'] ?></div>
              </div>

            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <!-- RIGHT IMAGE -->
      <div class="relative mb-12 lg:mb-0">
        <div class="relative shadow-2xl overflow-hidden rounded-3xl w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg h-64 sm:h-80 md:h-[450px] mx-auto">
          <swiper-container class="w-full h-full mySwiper"
            pagination="true"
            effect="cards"
            grab-cursor="true"
            loop="true"
            autoplay
            autoplay-delay="5000"
            autoplay-disable-on-interaction="true">
            <?php foreach ($slides as $s): ?>
              <swiper-slide class="!rounded-3xl overflow-hidden">
                <img src="<?= $s['img'] ?>" class="object-cover w-full h-full" alt="Healthcare Image" />
              </swiper-slide>
            <?php endforeach; ?>
          </swiper-container>
        </div>
      </div>

    </div>

  </div>

</section>