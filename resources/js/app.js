import './bootstrap';
import Alpine from 'alpinejs';

// Alpine.js Global Data
Alpine.data('navbar', () => ({
    scrolled: false,
    mobileOpen: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 20;
        });
    }
}));

Alpine.data('counter', () => ({
    animated: false,
    animate(el, target, duration = 2000) {
        if (this.animated) return;
        this.animated = true;
        const start = performance.now();
        const update = (time) => {
            const elapsed = time - start;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target).toLocaleString('id-ID');
            if (progress < 1) requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    }
}));

Alpine.data('toast', () => ({
    show: false,
    message: '',
    type: 'success',
    notify(msg, type = 'success') {
        this.message = msg;
        this.type = type;
        this.show = true;
        setTimeout(() => { this.show = false; }, 3500);
    }
}));

Alpine.start();

// Intersection Observer for scroll animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            // Trigger counter if it's a counter element
            const counter = entry.target.querySelector('[data-count]');
            if (counter) {
                const target = parseInt(counter.dataset.count);
                animateCounter(counter, target);
            }
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

function animateCounter(el, target, duration = 2000) {
    const start = performance.now();
    const update = (time) => {
        const elapsed = time - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target).toLocaleString('id-ID');
        if (progress < 1) requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
}
