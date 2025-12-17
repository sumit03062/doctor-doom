<?php
$why_choose_us = [
    [
        "lottie"    => "https://lottie.host/56b2b686-16a7-4a6b-9238-1366b5773276/LaqeaMRPrS.lottie",
        "title"     => "Multi-Specialty Care",
        "desc"      => "30+ departments including Cardiology, Neurology, Orthopedics, Pediatrics, Gynecology & more under one roof.",
        "stat"      => "30+",
        "stat_label" => "Specialties"
    ],
    [
        "lottie"    => "https://lottie.host/aa1b2c34-5678-4d9a-bcde-1234567890ab/ExampleHospital.lottie",
        "title"     => "World-Class Infrastructure",
        "desc"      => "500+ bed super-specialty hospital with latest diagnostic labs, modular OTs, ICU, and 24/7 emergency services.",
        "stat"      => "500+",
        "stat_label" => "Beds"
    ],
    [
        "lottie"    => "https://lottie.host/7d9e2c3f-1234-4abc-90de-abcdef123456/ExpertDoctor.lottie",
        "title"     => "Experienced Doctors",
        "desc"      => "Team of 200+ highly qualified doctors with national & international training and decades of expertise.",
        "stat"      => "200+",
        "stat_label" => "Expert Doctors"
    ],
    [
        "lottie"    => "https://lottie.host/9a8b7c6d-5678-4eab-90cd-1234abcdef56/TrustedPatients.lottie",
        "title"     => "Trusted by Millions",
        "desc"      => "Successfully treated over 1.5 million patients with 98%+ satisfaction rate across all specialties.",
        "stat"      => "1.5M+",
        "stat_label" => "Happy Patients"
    ],
    [
        "lottie"    => "https://lottie.host/0a1b2c3d-4567-4eab-89cd-abcdef123456/Affordable.lottie",
        "title"     => "Affordable Excellence",
        "desc"      => "Premium healthcare at transparent & affordable pricing. Multiple insurance & cashless options available.",
        "stat"      => "100%",
        "stat_label" => "Cashless Options"
    ],
    [
        "lottie"    => "https://lottie.host/1a2b3c4d-5678-4efg-90hi-abcdef654321/Emergency.lottie",
        "title"     => "24/7 Emergency & Pharmacy",
        "desc"      => "Round-the-clock emergency care, ambulance, diagnostics, blood bank and in-house pharmacy.",
        "stat"      => "24/7",
        "stat_label" => "Always Open"
    ]
];
?>

<section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-teal-50 via-blue-50 to-indigo-100 ">
    <div class="px-6 py-16 mx-auto max-w-7xl lg:py-24">

        <!-- Main Heading -->

        <div class="mb-16 text-center">
            <h3 class="inline-flex items-center gap-3 font-semibold text-teal-600 md:mb-4 md:text-2xl">
                <span class="w-12 h-0.5 bg-teal-600"></span>
                OUR SERVICES
            </h3>
            
            <h2 class="text-4xl font-bold leading-tight text-center text-gray-900 sm:text-5xl lg:text-6xl">
                Your Health Deserves the <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-blue-600">Best Care</span>
            </h2>
            
            <p class="max-w-3xl mx-auto mt-6 text-xl text-center text-gray-700">
                Advanced multi-specialty hospital delivering world-class treatment with compassion and trust.
            </p>
        </div>

        <!-- Facilities Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($why_choose_us as $item): ?>
                <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg cursor-pointer group rounded-3xl hover:shadow-2xl hover:-translate-y-3">
                    <div class="p-8 text-center">

                        <!-- Lottie Animation -->
                        <div class="inline-flex items-center justify-center w-24 h-24 mb-6 transition-all rounded-full bg-gradient-to-br from-teal-100 to-blue-100 group-hover:from-teal-200 group-hover:to-blue-200">
                            <dotlottie-wc
                                src="<?= $item['lottie'] ?>"
                                style="width:70px;height:70px"
                                autoplay
                                loop>
                            </dotlottie-wc>
                        </div>

                        <!-- Title -->
                        <h3 class="mb-3 text-2xl font-bold text-gray-900">
                            <?= htmlspecialchars($item['title']) ?>
                        </h3>

                        <!-- Description -->
                        <p class="mb-6 leading-relaxed text-gray-600">
                            <?= htmlspecialchars($item['desc']) ?>
                        </p>

                        <!-- Stat Highlight -->
                        <div class="inline-flex items-baseline">
                            <span class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-blue-600">
                                <?= $item['stat'] ?>
                            </span>
                            <span class="ml-2 text-lg text-gray-600"><?= $item['stat_label'] ?></span>
                        </div>
                    </div>

                    <!-- Hover CTA -->
                    <div class="py-4 text-center text-white transition-opacity duration-300 opacity-0 bg-gradient-to-r from-teal-600 to-blue-600 group-hover:opacity-100">
                        <a href="facilities.php" class="font-semibold">Explore More →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Bottom CTA -->


    </div>
</section>







<!-- Mobile -->

<!-- M<section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-teal-50 via-blue-50 to-indigo-100 ">
  <div class="px-6 py-16 mx-auto max-w-7xl lg:py-24">

    <div class="mb-16 text-center">
      <h1 class="text-4xl font-bold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
        Your Health Deserves the <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-blue-600">Best Care</span>
      </h1>
      <p class="max-w-3xl mx-auto mt-6 text-xl text-gray-700">
        Advanced multi-specialty hospital delivering world-class treatment with compassion and trust.
      </p>
    </div>

   

  </div>
</section>
 -->