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

// Gsap for BUttons

gsap.set(".tilt-btn", {
    transformPerspective: 800,
    transformOrigin: "center",
});

document.querySelectorAll(".tilt-btn").forEach((btn) => {
    btn.addEventListener("mousemove", (e) => {
        const rect = btn.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const rotateY = gsap.utils.interpolate(-40, 40, x / rect.width);
        const rotateX = gsap.utils.interpolate(40, -40, y / rect.height);

        gsap.to(btn, {
            rotationX: rotateX,
            rotationY: rotateY,
            scale: 1.05,
            duration: 0.3,
            ease: "power3.out",
        });
    });

    btn.addEventListener("mouseleave", () => {
        gsap.to(btn, {
            rotationX: 0,
            rotationY: 0,
            scale: 1,
            duration: 0.4,
            ease: "power3.out",
        });
    });
});

/* For Heading and Para */

gsap.registerPlugin(SplitText, ScrollTrigger);

let titleSplit, descSplit;

function initSplitText() {
    // Cleanup
    titleSplit && titleSplit.revert();
    descSplit && descSplit.revert();

    /* -------- TITLE (CHARS) -------- */
    titleSplit = new SplitText(".split-title", {
        type: "chars",
        charsClass: "char",
        nested: true, // 🔥 THIS FIXES THE SPAN ISSUE
        preserveWhitespace: true,
    });

    /* -------- DESCRIPTION (LINES) -------- */
    descSplit = new SplitText(".split-desc", {
        type: "lines",
        linesClass: "line",
    });

    // Title animation
    gsap.from(titleSplit.chars, {
        x: 80,
        opacity: 0,
        duration: 0.7,
        stagger: 0.04,
        ease: "power4.out",
        scrollTrigger: {
            trigger: ".split-title",
            start: "top 80%",
            once: true,
        },
    });

    // Description animation
    gsap.from(descSplit.lines, {
        rotationX: -60,
        transformOrigin: "50% 50% -100px",
        opacity: 0,
        duration: 0.8,
        stagger: 0.2,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".split-desc",
            start: "top 80%",
            once: true,
        },
    });
}

window.addEventListener("load", initSplitText);
window.addEventListener("resize", () => {
    gsap.delayedCall(0.2, initSplitText);
});

// animation for nav

console.clear();

const icons = document.querySelectorAll(".toolbarItem");
const dock = document.querySelector(".toolbar");

if (dock && icons.length) {
    const min = 48;
    const max = 70;
    const bound = min * Math.PI;

    gsap.set(icons, {
        transformOrigin: "40% 70%",
        scale: 1,
    });

    dock.addEventListener("mousemove", (e) => {
        const dockRect = dock.getBoundingClientRect();
        const pointerX = e.clientX - dockRect.left;
        updateIcons(pointerX);
    });

    dock.addEventListener("mouseleave", () => {
        gsap.to(icons, {
            scale: 1,
            x: 0,
            duration: 0.3,
            ease: "power3.out",
        });
    });

    function updateIcons(pointer) {
        icons.forEach((icon) => {
            const iconCenter = icon.offsetLeft + icon.offsetWidth / 2;

            const distance = iconCenter - pointer;

            let scale = 1;
            let x = 0;

            if (-bound < distance && distance < bound) {
                const rad = (distance / min) * 1;
                scale = 1 + (max / min - 1) * Math.cos(rad);
                x = 2 * (max - min) * Math.sin(rad);
            } else {
                x = distance > 0 ? -20 : 20;
            }

            gsap.to(icon, {
                scale,
                x,
                duration: 0.25,
                ease: "power3.out",
            });
        });
    }
}

// Gsap Buttons 2

gsap.registerPlugin(TextPlugin);

const btn = document.querySelector(".tilt-btnn");

const btnTL = gsap.timeline({ paused: true });

btnTL
    .to(btn, {
        duration: 0.6,
        text: {
            value: "Sending...",
            type: "diff",
        },
        ease: "sine.in",
    })
    .to(btn, {
        duration: 0.5,
        text: {
            value: "Sending",
            type: "diff",
        },
        ease: "sine.inOut",
        repeat: 4,
        yoyo: true,
    })
    .to(
        btn,
        {
            duration: 0.3,
            text: "Sent!",
            ease: "none",
        },
        "+=0.3"
    );

// Prevent submit + play animation
btn.addEventListener("click", (e) => {
    e.preventDefault(); // 🔴 IMPORTANT
    btnTL.play(0);
});

// for Footer


