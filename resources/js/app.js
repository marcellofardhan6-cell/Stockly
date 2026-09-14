import './bootstrap';

/* ====== Cursor-tracking glow on cards ===== */
if (window.matchMedia('(pointer: fine)').matches) {
    document.querySelectorAll('.glow-hover').forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--gx', `${((e.clientX - rect.left) / rect.width) * 100}%`);
            card.style.setProperty('--gy', `${((e.clientY - rect.top) / rect.height) * 100}%`);
        });
    });
}

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

/* ====== Notification dropdown ====== */
function initNotificationDropdown() {
    const notifBtn = document.getElementById('notif-btn');
    const notifPanel = document.getElementById('notif-panel');
    const notifDot = document.getElementById('notif-dot');
    const notifBadge = document.getElementById('notif-badge');
    const notifMarkRead = document.getElementById('notif-mark-read');
    const notifContainer = document.getElementById('notif-menu-container');

    if (!notifBtn || !notifPanel) return;

    const toggleNotif = (show) => {
        const isCurrentlyOpen = !notifPanel.classList.contains('hidden');
        const willOpen = typeof show === 'boolean' ? show : !isCurrentlyOpen;

        if (willOpen) {
            notifPanel.classList.remove('hidden');
            notifBtn.setAttribute('aria-expanded', 'true');
        } else {
            notifPanel.classList.add('hidden');
            notifBtn.setAttribute('aria-expanded', 'false');
        }
    };

    notifBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleNotif();
    });

    document.addEventListener('click', (e) => {
        if (notifContainer && !notifContainer.contains(e.target)) {
            toggleNotif(false);
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !notifPanel.classList.contains('hidden')) {
            toggleNotif(false);
            notifBtn.focus();
        }
    });

    if (notifMarkRead) {
        notifMarkRead.addEventListener('click', (e) => {
            e.stopPropagation();
            if (notifDot) notifDot.classList.add('hidden');
            if (notifBadge) {
                notifBadge.textContent = '0 baru';
                notifBadge.className = 'rounded-full bg-surface-hover px-2 py-0.5 text-xs font-medium text-muted';
            }
            document.querySelectorAll('.notif-unread-indicator').forEach((el) => el.remove());
            document.querySelectorAll('.notif-item').forEach((el) => {
                el.classList.remove('bg-amber-500/5', 'bg-danger-soft/40', 'bg-success-soft/40');
            });
            notifMarkRead.textContent = 'Semua dibaca';
            notifMarkRead.classList.add('opacity-50', 'pointer-events-none');
        });
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNotificationDropdown);
} else {
    initNotificationDropdown();
}

