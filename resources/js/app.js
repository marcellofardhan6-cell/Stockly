import './bootstrap';

document.querySelectorAll('[data-count-to]').forEach((el) => {
    const target = Number(el.dataset.countTo);
    const prefix = el.dataset.countPrefix ?? '';
    const duration = 850;
    const delay = Number(el.dataset.countDelay ?? 0);

    window.setTimeout(() => {
        const start = performance.now();

        const frame = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = prefix + new Intl.NumberFormat('id-ID').format(Math.round(target * eased));
            if (progress < 1) requestAnimationFrame(frame);
        };

        requestAnimationFrame(frame);
    }, delay);
});

const revealTargets = document.querySelectorAll('[data-reveal]');

if (revealTargets.length > 0) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -60px 0px' }
    );

    revealTargets.forEach((el) => observer.observe(el));
}

/* ====== Splash loading ====== */
const splash = document.querySelector('.splash');

if (splash) {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const hide = () => {
        splash.classList.add('hidden');
        window.setTimeout(() => splash.remove(), 450);
    };

    const minShown = 700; // pastikan splash terlihat sebentar walau load sangat cepat

    if (reducedMotion || document.readyState === 'complete') {
        window.setTimeout(hide, reducedMotion ? 50 : minShown);
    } else {
        window.addEventListener('load', () => {
            window.setTimeout(hide, minShown);
        });
        window.setTimeout(hide, 3500); // fallback keamanan
    }
}
