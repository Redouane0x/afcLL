import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// SCROLL ANIMATION
document.addEventListener("DOMContentLoaded", () => {

    const elements = document.querySelectorAll('.reveal');

    if (!elements.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    elements.forEach(el => observer.observe(el));
});

// PARALLAX HERO
window.addEventListener("scroll", () => {
    const hero = document.querySelector(".hero");
    if (!hero) return;

    let scroll = window.scrollY;
    hero.style.backgroundPositionY = scroll * 0.5 + "px";
});
