// GSAP Animation
gsap.from("#navbar", {
    y: -100,
    opacity: 0,
    duration: 1,
    ease: "power3.out",
});

document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
});

// Mobile menu toggle
const mobileBtn = document.querySelector("#mobileBtn");
console.log("We are here");
const mobileMenu = document.getElementById("mobileMenu");

let isOpen = false;

mobileBtn.addEventListener("click", () => {
    isOpen = !isOpen;
    mobileMenu.classList.toggle("hidden");

    // Change icon
    mobileBtn.innerHTML = isOpen
        ? '<i data-lucide="x" class="w-6 h-6"></i>'
        : '<i data-lucide="menu" class="w-6 h-6"></i>';

    lucide.createIcons();
    // console.log("Clicked");
});

// hero section

document.addEventListener("DOMContentLoaded", () => {
    const swiperEl = document.querySelector(".mySwiper");
    if (!swiperEl) return;

    const swiper = swiperEl.swiper; // get Swiper instance
    const textBlocks = document.querySelectorAll(".text-content");

    function syncText() {
        const i = swiper.realIndex; // current slide index
        textBlocks.forEach((el, idx) => {
            if (idx === i) {
                el.classList.remove("opacity-0", "pointer-events-none");
                el.classList.add("opacity-100");
            } else {
                el.classList.add("opacity-0", "pointer-events-none");
                el.classList.remove("opacity-100");
            }
        });
    }

    // Initial sync
    syncText();

    // Update on slide change
    swiper.on("slideChange", syncText);
});

