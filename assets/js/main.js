/**
 * Buzz Theme Main JavaScript
 *
 * @package Buzz_Theme
 */

(function() {
    'use strict';

    // DOM Elements
    const cursor = document.getElementById('bw-cursor');
    const cursorRing = document.getElementById('bw-cursor-ring');

    // Cursor tracking
    let mouseX = 0, mouseY = 0;
    let ringX = 0, ringY = 0;

    if (cursor && cursorRing) {
        document.addEventListener('mousemove', function(e) {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.left = (mouseX - 4) + 'px';
            cursor.style.top = (mouseY - 4) + 'px';
        });

        // Smooth ring follow
        (function animateRing() {
            ringX += (mouseX - ringX) * 0.1;
            ringY += (mouseY - ringY) * 0.1;
            cursorRing.style.left = (ringX - 16) + 'px';
            cursorRing.style.top = (ringY - 16) + 'px';
            requestAnimationFrame(animateRing);
        })();

        // Cursor hover effects
        const hoverElements = 'a, button, .bw-hiphop-card, .bw-mv-card, .bw-stream-card, .bw-inf-phone, .bw-ai-terminal, .bw-crypto-card, .bw-viral-card, .bw-app-c, .bw-v-link';

        document.querySelectorAll(hoverElements).forEach(function(el) {
            el.addEventListener('mouseenter', function() {
                cursor.style.transform = 'scale(2.5)';
                cursorRing.style.width = '52px';
                cursorRing.style.height = '52px';
            });
            el.addEventListener('mouseleave', function() {
                cursor.style.transform = 'scale(1)';
                cursorRing.style.width = '32px';
                cursorRing.style.height = '32px';
            });
        });
    }

    // Hero 3D Canvas
    (function initHeroCanvas() {
        const canvas = document.getElementById('bw-hero-canvas');
        if (!canvas) return;

        // Three.js loaded via CDN
        if (typeof THREE === 'undefined') return;

        const renderer = new THREE.WebGLRenderer({
            canvas: canvas,
            alpha: true,
            antialias: true
        });
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        renderer.setSize(canvas.offsetWidth, canvas.offsetHeight);

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(
            45,
            canvas.offsetWidth / canvas.offsetHeight,
            0.1,
            100
        );
        camera.position.set(0, 0, 6);

        // Main morphing wireframe sphere
        const geometry = new THREE.IcosahedronGeometry(2, 5);
        const material = new THREE.MeshStandardMaterial({
            color: 0xFF2D55,
            wireframe: true,
            transparent: true,
            opacity: 0.08
        });
        const sphere = new THREE.Mesh(geometry, material);
        sphere.position.set(3.5, 0.5, 0);
        scene.add(sphere);

        // Orbit ring
        const ringGeo = new THREE.TorusGeometry(3, 0.5, 4, 48);
        const ringMat = new THREE.MeshStandardMaterial({
            color: 0x7B61FF,
            wireframe: true,
            transparent: true,
            opacity: 0.06
        });
        const orbitRing = new THREE.Mesh(ringGeo, ringMat);
        orbitRing.position.set(3.5, 0.5, 0);
        orbitRing.rotation.x = Math.PI * 0.3;
        scene.add(orbitRing);

        // Inner sphere
        const innerGeo = new THREE.IcosahedronGeometry(1, 3);
        const innerMat = new THREE.MeshStandardMaterial({
            color: 0xFFE600,
            wireframe: true,
            transparent: true,
            opacity: 0.15
        });
        const inner = new THREE.Mesh(innerGeo, innerMat);
        inner.position.set(3.5, 0.5, 0);
        scene.add(inner);

        // Particles
        const particleGeo = new THREE.BufferGeometry();
        const particleArray = new Float32Array(1500 * 3);
        for (let i = 0; i < 1500 * 3; i++) {
            particleArray[i] = (Math.random() - 0.5) * 18;
        }
        particleGeo.setAttribute('position', new THREE.BufferAttribute(particleArray, 3));
        const particleMat = new THREE.PointsMaterial({
            color: 0xffffff,
            size: 0.012,
            transparent: true,
            opacity: 0.25
        });
        scene.add(new THREE.Points(particleGeo, particleMat));

        // Lights
        scene.add(new THREE.AmbientLight(0xffffff, 0.4));
        const pointLight1 = new THREE.PointLight(0xFF2D55, 3, 20);
        pointLight1.position.set(4, 3, 3);
        scene.add(pointLight1);
        const pointLight2 = new THREE.PointLight(0x7B61FF, 2, 15);
        pointLight2.position.set(-3, -2, 1);
        scene.add(pointLight2);
        const pointLight3 = new THREE.PointLight(0xFFE600, 1.5, 12);
        pointLight3.position.set(0, 4, 2);
        scene.add(pointLight3);

        // Mouse tracking for rotation
        const originalPositions = geometry.attributes.position.array.slice();
        const positions = geometry.attributes.position;
        let time = 0;
        let mouseNormX = 0, mouseNormY = 0;

        document.addEventListener('mousemove', function(e) {
            mouseNormX = (e.clientX / window.innerWidth - 0.5) * 2;
            mouseNormY = -(e.clientY / window.innerHeight - 0.5) * 2;
        });

        // Animation loop
        function render() {
            requestAnimationFrame(render);
            time += 0.005;

            // Morph vertices
            for (let i = 0; i < positions.count; i++) {
                const ox = originalPositions[i * 3];
                const oy = originalPositions[i * 3 + 1];
                const oz = originalPositions[i * 3 + 2];
                const n = Math.sin(ox * 1.8 + time) * Math.cos(oy * 1.8 + time) * 0.18;
                positions.array[i * 3] = ox + ox * n;
                positions.array[i * 3 + 1] = oy + oy * n;
                positions.array[i * 3 + 2] = oz + oz * n;
            }
            positions.needsUpdate = true;
            geometry.computeVertexNormals();

            sphere.rotation.x = time * 0.07 + mouseNormY * 0.15;
            sphere.rotation.y = time * 0.1 + mouseNormX * 0.15;
            orbitRing.rotation.y = time * 0.05;
            orbitRing.rotation.z = time * 0.03;
            inner.rotation.x = -time * 0.12;
            inner.rotation.y = time * 0.18;

            renderer.render(scene, camera);
        }
        render();

        // Resize handler
        window.addEventListener('resize', function() {
            const width = canvas.offsetWidth;
            const height = canvas.offsetHeight;
            renderer.setSize(width, height);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        });
    })();

    // Scroll reveal animation
    (function initScrollReveal() {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('bw-visible');
                }
            });
        }, {
            threshold: 0.08
        });

        document.querySelectorAll('.bw-reveal').forEach(function(el) {
            observer.observe(el);
        });
    })();

    // Frequency bars random animation
    (function initFreqBars() {
        document.querySelectorAll('.bw-freq-b').forEach(function(bar, index) {
            bar.style.animationDuration = (0.5 + Math.random() * 0.8) + 's';
            bar.style.animationDelay = (index * 0.1) + 's';
        });
    })();

    // Vertical nav active state on scroll
    (function initNavScroll() {
        const sections = {
            'hiphop': 0,
            'movies-tv': 1,
            'streaming': 2,
            'creators': 3,
            'ai-lab': 4,
            'crypto': 5,
            'viral': 6
        };

        const navLinks = document.querySelectorAll('.bw-v-link');
        const sectionElements = Object.keys(sections).map(function(id) {
            return document.getElementById(id);
        }).filter(Boolean);

        window.addEventListener('scroll', function() {
            let current = 0;
            sectionElements.forEach(function(s, i) {
                if (s && window.scrollY >= s.offsetTop - 300) {
                    current = i;
                }
            });

            navLinks.forEach(function(l) {
                l.classList.remove('active');
            });
            if (navLinks[current]) {
                navLinks[current].classList.add('active');
            }
        });
    })();

    // Newsletter form
    (function initNewsletter() {
        const form = document.getElementById('bw-newsletter-form');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const input = form.querySelector('input[type="email"]');
            const email = input.value;

            if (!email) return;

            // AJAX submission
            const xhr = new XMLHttpRequest();
            xhr.open('POST', buzzData.ajaxUrl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-WP-Nonce', buzzData.nonce);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    input.value = '';
                    input.placeholder = 'Thanks for subscribing!';
                    setTimeout(function() {
                        input.placeholder = 'your@email.com';
                    }, 3000);
                }
            };

            xhr.send('action=buzz_newsletter_subscribe&nonce=' + buzzData.nonce + '&email=' + encodeURIComponent(email));
        });
    })();

    // Smooth scroll for anchor links
    (function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    })();

    // Lazy load images
    (function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    })();

})();
