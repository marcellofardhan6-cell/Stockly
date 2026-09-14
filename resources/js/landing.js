/* ============================================================
   Stockly Landing — premium interactions
   ============================================================ */
(function () {
    'use strict';

    // Selalu mulai dari atas saat halaman di-refresh
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    window.scrollTo(0, 0);

    // Catatan: animasi landing SELALU dimainkan sesuai permintaan pemilik,
    // jadi kita tidak menonaktifkan reveal berdasarkan prefers-reduced-motion.
    const finePointer = window.matchMedia('(pointer: fine)').matches;

    /* ---------- Navbar solid on scroll ---------- */
    const navbar = document.querySelector('.nav-glass');
    if (navbar) {
        const onScroll = () => {
            navbar.classList.toggle('nav-scrolled', window.scrollY > 40);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ---------- Scroll reveal ---------- */
    const revealEls = Array.from(document.querySelectorAll('.landing-reveal'));
    const staggerEls = Array.from(document.querySelectorAll('.stagger-grid'));
    const allReveal = revealEls.concat(staggerEls);

    const reveal = (el) => el.classList.add('is-in');

    // Cek apakah elemen sudah (atau hampir) masuk viewport
    const checkReveal = () => {
        const vh = window.innerHeight;
        allReveal.forEach((el) => {
            if (el.classList.contains('is-in')) return;
            const r = el.getBoundingClientRect();
            // Muncul saat bagian atas elemen berada 12% dari bawah viewport
            if (r.top < vh * 0.88 && r.bottom > 0) {
                reveal(el);
            }
        });
    };

    // Jalankan saat load, scroll, dan resize — dijamin bekerja di semua browser
    checkReveal();
    window.addEventListener('scroll', checkReveal, { passive: true });
    window.addEventListener('resize', checkReveal, { passive: true });
    // Fallback ekstra untuk konten yang dimuat lambat
    window.setTimeout(checkReveal, 400);
    window.setTimeout(checkReveal, 1200);

    /* ---------- Animated counters ---------- */
    const counters = document.querySelectorAll('[data-count-to]');

    const animateCount = (el) => {
        const target = parseFloat(el.dataset.countTo);
        const decimals = parseInt(el.dataset.countDecimals || '0', 10);
        const prefix = el.dataset.countPrefix || '';
        const suffix = el.dataset.countSuffix || '';
        const duration = 1600;
        const start = performance.now();

        const frame = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 4);
            const val = target * eased;
            el.textContent = prefix + val.toLocaleString('id-ID', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals,
            }) + suffix;
            if (p < 1) requestAnimationFrame(frame);
        };

        requestAnimationFrame(frame);
    };

    if (counters.length) {
        const cio = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCount(entry.target);
                        cio.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );
        counters.forEach((el) => cio.observe(el));
    }

    if (!finePointer) return;

    /* ---------- Cursor glow follower ---------- */
    const glow = document.querySelector('.cursor-glow');
    if (glow) {
        let gx = -500, gy = -500, cx = -500, cy = -500, glowActive = false;

        window.addEventListener('mousemove', (e) => {
            gx = e.clientX;
            gy = e.clientY;
            if (!glowActive) {
                glowActive = true;
                glow.style.opacity = '1';
            }
        }, { passive: true });

        document.documentElement.addEventListener('mouseleave', () => {
            glowActive = false;
            glow.style.opacity = '0';
        });

        (function followGlow() {
            cx += (gx - cx) * 0.08;
            cy += (gy - cy) * 0.08;
            glow.style.transform = `translate(${cx - glow.offsetWidth / 2}px, ${cy - glow.offsetHeight / 2}px)`;
            requestAnimationFrame(followGlow);
        })();
    }

    /* ---------- 3D tilt cards ---------- */
    document.querySelectorAll('.tilt').forEach((card) => {
        const strength = parseFloat(card.dataset.tiltStrength || '8');
        let raf = null;

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const px = (e.clientX - rect.left) / rect.width;
            const py = (e.clientY - rect.top) / rect.height;

            card.style.setProperty('--gx', `${px * 100}%`);
            card.style.setProperty('--gy', `${py * 100}%`);

            if (raf) return;
            raf = requestAnimationFrame(() => {
                const rx = (0.5 - py) * strength;
                const ry = (px - 0.5) * strength;
                card.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-4px)`;
                raf = null;
            });
        });

        card.addEventListener('mouseleave', () => {
            if (raf) cancelAnimationFrame(raf);
            raf = null;
            card.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg) translateY(0)';
        });
    });

    /* ---------- Glow-only hover (non-tilt cards) ---------- */
    document.querySelectorAll('.glow-hover').forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--gx', `${((e.clientX - rect.left) / rect.width) * 100}%`);
            card.style.setProperty('--gy', `${((e.clientY - rect.top) / rect.height) * 100}%`);
        });
    });

    /* ---------- Magnetic buttons ---------- */
    document.querySelectorAll('.magnetic').forEach((btn) => {
        const strength = parseFloat(btn.dataset.magneticStrength || '0.25');

        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const relX = e.clientX - rect.left - rect.width / 2;
            const relY = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${relX * strength}px, ${relY * strength}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });

    /* ---------- Parallax on scroll ---------- */
    const parallaxEls = document.querySelectorAll('[data-parallax]');
    if (parallaxEls.length) {
        let ticking = false;

        const updateParallax = () => {
            const vh = window.innerHeight;
            parallaxEls.forEach((el) => {
                const speed = parseFloat(el.dataset.parallax || '0.15');
                const rect = el.getBoundingClientRect();
                const center = rect.top + rect.height / 2;
                const offset = (center - vh / 2) * speed;
                el.style.transform = `translateY(${offset.toFixed(1)}px)`;
            });
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }, { passive: true });

        updateParallax();
    }
})();