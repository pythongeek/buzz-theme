/* ============================================================
   BUZZWIRE DAILY — MAIN JAVASCRIPT v2.0
   Compiled from homepage template
   @package Buzz_Theme
   ============================================================ */

(function() {
  'use strict';

  /* ── HAMBURGER NAV ── */
  var btn = document.getElementById('hamburgerBtn');
  var drawer = document.getElementById('mobileNavDrawer');
  if (btn && drawer) {
    btn.addEventListener('click', function() {
      var isOpen = drawer.classList.toggle('open');
      btn.classList.toggle('open', isOpen);
      btn.setAttribute('aria-expanded', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });
    // Close on item click
    drawer.querySelectorAll('.mobile-nav-item').forEach(function(item) {
      item.addEventListener('click', function() {
        drawer.classList.remove('open');
        btn.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      });
    });
    // Close on outside click
    document.addEventListener('click', function(e) {
      if (!drawer.contains(e.target) && !btn.contains(e.target)) {
        drawer.classList.remove('open');
        btn.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  }

  /* ── CUSTOM CURSOR (fine pointer devices only) ── */
  if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
    var cur = document.getElementById('cur');
    var ring = document.getElementById('cur-r');
    if (cur && ring) {
      var mx = 0, my = 0, rx = 0, ry = 0;
      document.addEventListener('mousemove', function(e) {
        mx = e.clientX; my = e.clientY;
        cur.style.left = (mx - 4) + 'px';
        cur.style.top  = (my - 4) + 'px';
      });
      (function animRing() {
        rx += (mx - rx) * 0.1;
        ry += (my - ry) * 0.1;
        ring.style.left = (rx - 16) + 'px';
        ring.style.top  = (ry - 16) + 'px';
        requestAnimationFrame(animRing);
      })();
      document.querySelectorAll(
        'a, button, .hh-card, .mv-card, .st-card, .inf-phone, .ai-terminal, .cr-card, .vr-card, .app-c, .v-link'
      ).forEach(function(el) {
        el.addEventListener('mouseenter', function() {
          cur.style.transform = 'scale(2.5)';
          ring.style.width = '52px'; ring.style.height = '52px';
        });
        el.addEventListener('mouseleave', function() {
          cur.style.transform = 'scale(1)';
          ring.style.width = '32px'; ring.style.height = '32px';
        });
      });
    }
  }

  /* ── HERO 3D (lazy-loaded after page interactive) ── */
  function initHero3D() {
    var canvas = document.getElementById('hero-canvas');
    if (!canvas || typeof THREE === 'undefined') return;
    // Skip on low-end / mobile to save battery
    var isLowEnd = !window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    if (isLowEnd) return;

    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setSize(canvas.offsetWidth, canvas.offsetHeight);

    var scene = new THREE.Scene();
    var cam = new THREE.PerspectiveCamera(45, canvas.offsetWidth / canvas.offsetHeight, 0.1, 100);
    cam.position.set(0, 0, 6);

    var geo = new THREE.IcosahedronGeometry(2, 5);
    var mat = new THREE.MeshStandardMaterial({ color: 0xFF2D55, wireframe: true, transparent: true, opacity: 0.08 });
    var sphere = new THREE.Mesh(geo, mat);
    sphere.position.set(3.5, 0.5, 0);
    scene.add(sphere);

    var rGeo = new THREE.TorusGeometry(3, 0.5, 4, 48);
    var rMat = new THREE.MeshStandardMaterial({ color: 0x7B61FF, wireframe: true, transparent: true, opacity: 0.06 });
    var ring3 = new THREE.Mesh(rGeo, rMat);
    ring3.position.set(3.5, 0.5, 0);
    ring3.rotation.x = Math.PI * 0.3;
    scene.add(ring3);

    var iGeo = new THREE.IcosahedronGeometry(1, 3);
    var iMat = new THREE.MeshStandardMaterial({ color: 0xFFE600, wireframe: true, transparent: true, opacity: 0.15 });
    var inner = new THREE.Mesh(iGeo, iMat);
    inner.position.set(3.5, 0.5, 0);
    scene.add(inner);

    var pG = new THREE.BufferGeometry();
    var pArr = new Float32Array(1500 * 3);
    for (var i = 0; i < 1500 * 3; i++) pArr[i] = (Math.random() - 0.5) * 18;
    pG.setAttribute('position', new THREE.BufferAttribute(pArr, 3));
    var pM = new THREE.PointsMaterial({ color: 0xffffff, size: 0.012, transparent: true, opacity: 0.25 });
    scene.add(new THREE.Points(pG, pM));

    scene.add(new THREE.AmbientLight(0xffffff, 0.4));
    var pl = new THREE.PointLight(0xFF2D55, 3, 20); pl.position.set(4, 3, 3); scene.add(pl);
    var pl2 = new THREE.PointLight(0x7B61FF, 2, 15); pl2.position.set(-3, -2, 1); scene.add(pl2);
    var pl3 = new THREE.PointLight(0xFFE600, 1.5, 12); pl3.position.set(0, 4, 2); scene.add(pl3);

    var orig = geo.attributes.position.array.slice();
    var pos = geo.attributes.position;
    var t = 0, mmx = 0, mmy = 0;

    document.addEventListener('mousemove', function(e) {
      mmx = (e.clientX / window.innerWidth - 0.5) * 2;
      mmy = -(e.clientY / window.innerHeight - 0.5) * 2;
    });

    var paused = false;
    document.addEventListener('visibilitychange', function() { paused = document.hidden; });

    function render() {
      requestAnimationFrame(render);
      if (paused) return;
      t += 0.005;
      for (var j = 0; j < pos.count; j++) {
        var ox = orig[j*3], oy = orig[j*3+1], oz = orig[j*3+2];
        var n = Math.sin(ox * 1.8 + t) * Math.cos(oy * 1.8 + t) * 0.18;
        pos.array[j*3] = ox + ox*n;
        pos.array[j*3+1] = oy + oy*n;
        pos.array[j*3+2] = oz + oz*n;
      }
      pos.needsUpdate = true;
      geo.computeVertexNormals();
      sphere.rotation.x = t * 0.07 + mmy * 0.15;
      sphere.rotation.y = t * 0.1  + mmx * 0.15;
      ring3.rotation.y  = t * 0.05;
      ring3.rotation.z  = t * 0.03;
      inner.rotation.x  = -t * 0.12;
      inner.rotation.y  =  t * 0.18;
      renderer.render(scene, cam);
    }
    render();

    var resizeTimer;
    window.addEventListener('resize', function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
        var w = canvas.offsetWidth, h = canvas.offsetHeight;
        renderer.setSize(w, h);
        cam.aspect = w / h;
        cam.updateProjectionMatrix();
      }, 150);
    });
  }

  // Load Three.js then init
  if (typeof THREE !== 'undefined') {
    initHero3D();
  } else {
    var threeScript = document.querySelector('script[src*="three"]');
    if (threeScript) threeScript.addEventListener('load', initHero3D);
  }

  /* ── SCROLL REVEAL ── */
  if ('IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(e) {
        if (e.isIntersecting) {
          e.target.classList.add('on');
          obs.unobserve(e.target); // fire once
        }
      });
    }, { threshold: 0.07 });
    document.querySelectorAll('.reveal').forEach(function(r) { obs.observe(r); });
  } else {
    // Fallback: show all immediately
    document.querySelectorAll('.reveal').forEach(function(r) { r.classList.add('on'); });
  }

  /* ── FREQ BARS: randomize animation durations ── */
  document.querySelectorAll('.freq-b').forEach(function(b) {
    b.style.animationDuration = (0.5 + Math.random() * 0.8) + 's';
  });

  /* ── NEWSLETTER SUBMIT ── */
  var nlBtn = document.getElementById('nlSubmit');
  var nlEmail = document.getElementById('nl-email');
  if (nlBtn && nlEmail) {
    nlBtn.addEventListener('click', function() {
      var val = nlEmail.value.trim();
      if (val && val.includes('@') && val.includes('.')) {
        nlBtn.textContent = '✓ Joined!';
        nlBtn.style.background = '#28a745';
        nlEmail.value = '';
        // WordPress AJAX integration point:
        // var data = new FormData();
        // data.append('action', 'buzzwire_newsletter_signup');
        // data.append('email', val);
        // data.append('nonce', buzzwireVars.nonce);
        // fetch(buzzwireVars.ajaxUrl, { method: 'POST', body: data });
        setTimeout(function() {
          nlBtn.textContent = 'Join →';
          nlBtn.style.background = '';
        }, 3500);
      } else {
        nlEmail.style.borderColor = 'rgba(255,45,85,.6)';
        nlEmail.focus();
        setTimeout(function() { nlEmail.style.borderColor = ''; }, 2000);
      }
    });
    nlEmail.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') nlBtn.click();
    });
  }

  /* ── KEYBOARD NAV: vertical nav ── */
  document.querySelectorAll('.v-link').forEach(function(link) {
    link.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        link.click();
      }
    });
  });

  /* ── SCREEN READER ONLY UTILITY ── */
  var style = document.createElement('style');
  style.textContent = '.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}';
  document.head.appendChild(style);

})();
</script>
</body>
</html>
HTMLEOF
echo "Done"
Output

Done
Done

You are out of free messages until 5:20 AM
Upgrade




Claude is AI and can make mistakes. Please double-check responses.
Pasted content
52.42 KB •586 lines
•
Formatting may be inconsistent from source
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BUZZWIRE DAILY — VOID SIGNAL (Preview)</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Mono:ital,wght@0,300;0,400;0,500;1,400&family=Playfair+Display:ital,wght@0,700;0,900;1,700;1,900&family=Rajdhani:wght@400;500;600;700&family=Barlow+Condensed:ital,wght@0,400;0,700;0,900;1,900&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:#030305;color:#fff;overflow-x:hidden;cursor:none;font-family:'DM Mono',monospace}
::-webkit-scrollbar{width:2px}::-webkit-scrollbar-track{background:#030305}::-webkit-scrollbar-thumb{background:#FF2D55}

/* CURSOR */
#cur{position:fixed;width:8px;height:8px;background:#FF2D55;border-radius:50%;pointer-events:none;z-index:9999;transition:transform .1s;mix-blend-mode:screen}
#cur-r{position:fixed;width:32px;height:32px;border:1px solid rgba(255,45,85,.35);border-radius:50%;pointer-events:none;z-index:9998;transition:left .2s ease,top .2s ease,width .2s,height .2s}

/* NAV */
.v-nav{position:fixed;left:0;top:0;bottom:0;width:56px;background:rgba(3,3,5,.97);border-right:1px solid rgba(255,255,255,.06);z-index:200;display:flex;flex-direction:column;align-items:center;padding:24px 0}
.v-logo{font-family:'Bebas Neue',cursive;font-size:11px;letter-spacing:.35em;writing-mode:vertical-rl;text-orientation:mixed;color:#fff;margin-bottom:32px;transform:rotate(180deg)}
.v-logo span{color:#FF2D55}
.v-divider{width:20px;height:1px;background:rgba(255,255,255,.08);margin:8px 0}
.v-links{display:flex;flex-direction:column;gap:4px;width:100%;align-items:center;flex:1}
.v-link{width:40px;height:40px;display:flex;align-items:center;justify-content:center;font-size:14px;border-radius:6px;transition:background .2s;cursor:none;position:relative}
.v-link:hover{background:rgba(255,255,255,.06)}
.v-link.active{background:rgba(255,45,85,.12);border:1px solid rgba(255,45,85,.25)}
.v-tooltip{position:absolute;left:54px;background:#111;border:1px solid rgba(255,255,255,.08);padding:4px 10px;font-size:9px;letter-spacing:.15em;white-space:nowrap;opacity:0;pointer-events:none;transition:opacity .15s;font-family:'DM Mono',monospace;text-transform:uppercase}
.v-link:hover .v-tooltip{opacity:1}
.v-live{margin-top:auto;padding:8px 0;font-size:8px;letter-spacing:.15em;color:#FF2D55;display:flex;flex-direction:column;align-items:center;gap:5px}
.v-dot{width:5px;height:5px;background:#FF2D55;border-radius:50%;animation:vdot 1.4s infinite}
@keyframes vdot{0%,100%{opacity:1}50%{opacity:.2}}

main{margin-left:56px}

/* HERO */
.hero{position:relative;height:100vh;overflow:hidden;display:flex;flex-direction:column;justify-content:flex-end;padding:0 6vw 60px}
#hero-canvas{position:absolute;inset:0;width:100%;height:100%;pointer-events:none}
.hero-eyebrow{font-size:9px;letter-spacing:.3em;color:#FF2D55;text-transform:uppercase;margin-bottom:20px;display:flex;align-items:center;gap:10px}
.hero-eyebrow::before{content:'';width:24px;height:1px;background:#FF2D55}
.hero-h1{font-family:'Bebas Neue',cursive;font-size:clamp(70px,11vw,160px);line-height:.88;letter-spacing:.02em;color:#fff}
.hero-h1 .outline{-webkit-text-stroke:1px rgba(255,255,255,.2);color:transparent}
.hero-h1 .red{color:#FF2D55}
.hero-bottom{margin-top:40px;display:flex;align-items:flex-end;justify-content:space-between}
.hero-desc{font-size:11px;color:rgba(255,255,255,.45);line-height:1.8;max-width:320px}
.hero-btn{font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.18em;text-transform:uppercase;padding:14px 32px;background:#FF2D55;color:#000;border:none;cursor:none;transition:transform .2s,box-shadow .2s}
.hero-btn:hover{transform:translateY(-3px);box-shadow:0 16px 50px rgba(255,45,85,.3)}
.hero-scroll{position:absolute;right:6vw;top:50%;transform:translateY(-50%);writing-mode:vertical-rl;font-size:9px;letter-spacing:.25em;color:rgba(255,255,255,.2);display:flex;align-items:center;gap:8px}
.h-scroll-line{width:1px;height:48px;background:rgba(255,255,255,.1);position:relative;overflow:hidden}
.h-scroll-line::after{content:'';position:absolute;top:-100%;width:100%;height:50%;background:#FF2D55;animation:vscroll 2s ease infinite}
@keyframes vscroll{to{top:200%}}

/* TICKER */
.ticker{background:#FF2D55;padding:9px 0;overflow:hidden}
.ticker-wrap{display:flex;white-space:nowrap;animation:tick 30s linear infinite}
.t-item{font-size:10px;letter-spacing:.14em;text-transform:uppercase;padding:0 28px;color:#000;flex-shrink:0}
.t-item::after{content:'  ✦  '}
@keyframes tick{from{transform:translateX(0)}to{transform:translateX(-50%)}}

.ns{position:relative;overflow:hidden}

/* HIP-HOP */
.ns-hiphop{background:#070000;padding:80px 5vw}
.ns-hiphop::before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle at 80% 50%,rgba(255,230,0,.03) 0%,transparent 60%),radial-gradient(circle at 10% 80%,rgba(204,0,0,.05) 0%,transparent 50%)}
.hh-header{margin-bottom:48px}
.hh-label{font-family:'Bebas Neue',cursive;font-size:9px;letter-spacing:.4em;color:#CC0000;text-transform:uppercase;margin-bottom:8px;display:flex;align-items:center;gap:10px}
.hh-label::before{content:'▶';font-size:7px}
.hh-title{font-family:'Bebas Neue',cursive;font-size:clamp(64px,9vw,130px);line-height:.88;color:#FFE600;letter-spacing:.02em}
.hh-title .white{color:#fff}
.hh-sub{font-size:11px;color:rgba(255,255,255,.35);letter-spacing:.08em;margin-top:8px}
.hh-grid{display:grid;grid-template-columns:2fr 1fr 1fr;grid-template-rows:auto auto;gap:3px}
.hh-card{background:#110000;padding:28px 24px;position:relative;overflow:hidden;cursor:pointer;transition:background .2s}
.hh-card:hover{background:#180000}
.hh-card::after{content:'';position:absolute;top:0;left:0;width:3px;height:0;background:#FFE600;transition:height .3s}
.hh-card:hover::after{height:100%}
.hh-card.main{grid-row:1/3;padding:36px 32px;border-left:4px solid #CC0000}
.hh-big-num{font-family:'Bebas Neue',cursive;font-size:80px;line-height:1;color:rgba(255,230,0,.07);position:absolute;right:20px;bottom:10px}
.hh-cat{font-size:8px;letter-spacing:.3em;color:#CC0000;text-transform:uppercase;margin-bottom:12px}
.hh-ttl{font-family:'Barlow Condensed',sans-serif;font-size:clamp(20px,2.5vw,32px);font-weight:900;line-height:1.1;color:#fff;margin-bottom:10px}
.hh-card.main .hh-ttl{font-size:clamp(28px,3.5vw,48px)}
.hh-ex{font-size:11px;color:rgba(255,255,255,.4);line-height:1.7}
.hh-meta{margin-top:16px;padding-top:12px;border-top:1px solid rgba(255,255,255,.06);font-size:9px;color:rgba(255,255,255,.3);display:flex;justify-content:space-between}
.hh-fire{color:#FF2D55;font-weight:700}
.freq-bar{display:flex;gap:2px;align-items:flex-end;height:28px;margin-top:16px}
.freq-b{width:4px;background:#FFE600;border-radius:1px;animation:freq .8s ease infinite alternate}
@keyframes freq{to{transform:scaleY(.2)}}

/* MOVIES */
.ns-movies{background:#000;padding:80px 5vw;position:relative}
.film-grain{position:absolute;inset:0;pointer-events:none;z-index:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23g)' opacity='0.04'/%3E%3C/svg%3E");opacity:.6}
.film-strip-l{position:absolute;left:0;top:0;bottom:0;width:28px;background:#050505;border-right:1px solid rgba(255,255,255,.04);z-index:1;display:flex;flex-direction:column;justify-content:space-around;align-items:center;padding:20px 0}
.sprocket{width:10px;height:14px;background:#111;border:1px solid #222;border-radius:2px}
.movies-content{position:relative;z-index:2;padding-left:40px}
.mv-label{font-family:'DM Mono',monospace;font-size:8px;letter-spacing:.3em;color:rgba(255,255,255,.3);text-transform:uppercase;margin-bottom:8px}
.mv-title{font-family:'Playfair Display',serif;font-size:clamp(48px,6vw,88px);font-style:italic;font-weight:900;color:#E8E8E8;line-height:.95;margin-bottom:40px}
.mv-title span{color:#8B1A1A}
.mv-row{display:grid;grid-template-columns:1.6fr 1fr 1fr;gap:1px;background:rgba(255,255,255,.04)}
.mv-card{background:#000;overflow:hidden;cursor:pointer}
.mv-frame{width:100%;padding-top:56.25%;position:relative;overflow:hidden}
.mv-img{position:absolute;inset:0;transition:transform .6s}
.mv-card:hover .mv-img{transform:scale(1.04)}
.mv-lb-top,.mv-lb-bot{position:absolute;left:0;right:0;height:12px;background:#000;z-index:2}
.mv-lb-top{top:0}.mv-lb-bot{bottom:0}
.mv-card-body{padding:20px 20px 24px}
.mv-score{display:inline-block;font-family:'Playfair Display',serif;font-style:italic;font-size:11px;color:#888;border:1px solid rgba(255,255,255,.08);padding:3px 10px;margin-bottom:10px}
.mv-ttl{font-family:'Playfair Display',serif;font-size:clamp(14px,1.8vw,20px);font-weight:700;line-height:1.2;color:#E8E8E8;margin-bottom:8px}
.mv-ex{font-size:10px;color:rgba(255,255,255,.35);line-height:1.7}
.mv-meta{font-size:9px;color:rgba(255,255,255,.2);margin-top:12px;display:flex;gap:12px}

/* STREAMING */
.ns-stream{background:#03030F;padding:80px 5vw}
.ns-stream::before{content:'';position:absolute;inset:0;background:repeating-linear-gradient(0deg,transparent,transparent 47px,rgba(255,255,255,.015) 47px,rgba(255,255,255,.015) 48px)}
.st-header{display:grid;grid-template-columns:1fr auto;align-items:start;margin-bottom:48px;position:relative;z-index:1}
.st-label{font-size:9px;letter-spacing:.3em;color:#4488FF;text-transform:uppercase;margin-bottom:8px}
.st-title{font-family:'Rajdhani',sans-serif;font-weight:700;font-size:clamp(40px,5vw,72px);color:#fff;line-height:1}
.st-title span{color:#4488FF}
.st-status{background:rgba(68,136,255,.08);border:1px solid rgba(68,136,255,.2);padding:12px 20px;font-size:9px;letter-spacing:.15em;color:#4488FF}
.st-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1px;background:rgba(255,255,255,.04);position:relative;z-index:1}
.st-card{background:#03030F;padding:28px 24px;cursor:pointer;transition:background .2s;position:relative}
.st-card:hover{background:#06062a}
.st-platforms{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:16px}
.plt{font-size:8px;letter-spacing:.1em;text-transform:uppercase;padding:3px 8px;border-radius:2px;font-family:'DM Mono',monospace}
.plt-nf{background:rgba(229,9,20,.15);color:#E50914;border:1px solid rgba(229,9,20,.25)}
.plt-pr{background:rgba(0,168,225,.15);color:#00A8E1;border:1px solid rgba(0,168,225,.25)}
.plt-di{background:rgba(1,110,203,.15);color:#016ECB;border:1px solid rgba(1,110,203,.25)}
.plt-hb{background:rgba(102,0,204,.15);color:#6600CC;border:1px solid rgba(102,0,204,.25)}
.plt-fr{background:rgba(0,200,100,.15);color:#00C864;border:1px solid rgba(0,200,100,.25)}
.st-ttl{font-family:'Rajdhani',sans-serif;font-weight:700;font-size:clamp(16px,2vw,22px);color:#fff;line-height:1.2;margin-bottom:8px}
.st-ex{font-size:10px;color:rgba(255,255,255,.35);line-height:1.7}
.st-bar{height:2px;background:rgba(255,255,255,.06);margin:16px 0 8px;position:relative}
.st-bar-fill{position:absolute;left:0;top:0;height:100%;background:#4488FF}
.st-meta{font-size:9px;color:rgba(255,255,255,.25);display:flex;justify-content:space-between}

/* INFLUENCERS */
.ns-inf{background:#080012;padding:80px 5vw;position:relative}
.ns-inf::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 20% 50%,rgba(255,0,110,.05) 0%,transparent 50%),radial-gradient(ellipse at 80% 30%,rgba(0,217,255,.04) 0%,transparent 50%)}
.inf-label{font-size:9px;letter-spacing:.25em;color:#FF006E;text-transform:uppercase;margin-bottom:8px;position:relative;z-index:1}
.inf-title{font-family:'Barlow Condensed',sans-serif;font-size:clamp(48px,7vw,96px);font-weight:900;font-style:italic;line-height:.9;color:#fff;margin-bottom:40px;position:relative;z-index:1}
.inf-title .hot{color:#FF006E}
.inf-title .cold{color:#00D9FF}
.inf-phones{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;position:relative;z-index:1}
.inf-phone{background:#0F001F;border:1px solid rgba(255,0,110,.15);padding:0 0 16px;cursor:pointer;transition:transform .2s,border-color .2s;position:relative;overflow:hidden}
.inf-phone:hover{transform:translateY(-6px);border-color:rgba(255,0,110,.4)}
.inf-phone:nth-child(2){transform:translateY(20px)}
.inf-phone:nth-child(3){transform:translateY(10px)}
.inf-phone-screen{width:100%;padding-top:130%;position:relative;margin-bottom:12px;overflow:hidden}
.inf-screen-bg{position:absolute;inset:0}
.inf-notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:40%;height:16px;background:#080012;z-index:3;border-radius:0 0 10px 10px}
.inf-stats{position:absolute;bottom:12px;left:0;right:0;padding:0 10px;z-index:2;display:flex;justify-content:space-between}
.inf-stat-chip{font-size:8px;padding:3px 8px;background:rgba(0,0,0,.7);border-radius:20px;letter-spacing:.05em}
.inf-body{padding:0 14px}
.inf-creator{font-size:9px;letter-spacing:.15em;color:#FF006E;margin-bottom:4px;text-transform:uppercase}
.inf-ttl{font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px;line-height:1.2;color:#fff}
.inf-eng{font-size:9px;color:rgba(255,255,255,.3);margin-top:6px;display:flex;gap:10px}
.inf-eng span{color:#00D9FF}

/* AI */
.ns-ai{background:#000;padding:80px 5vw;position:relative}
.ns-ai::before{content:'';position:absolute;inset:0;pointer-events:none;background:repeating-linear-gradient(0deg,rgba(0,255,65,.02) 0px,transparent 1px,transparent 3px,rgba(0,255,65,.01) 4px);animation:scan 8s linear infinite}
@keyframes scan{to{background-position:0 100vh}}
.ai-header{margin-bottom:48px;position:relative;z-index:1}
.ai-prompt{font-size:11px;letter-spacing:.08em;color:rgba(0,255,65,.5);margin-bottom:4px}
.ai-prompt::before{content:'> '}
.ai-title{font-family:'DM Mono',monospace;font-size:clamp(28px,4vw,56px);font-weight:400;color:#00FF41;line-height:1.1}
.ai-title::after{content:'_';animation:blink .9s step-end infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.ai-grid{display:grid;grid-template-columns:1fr 1fr;gap:2px;position:relative;z-index:1}
.ai-terminal{background:#020602;border:1px solid rgba(0,255,65,.12);font-family:'DM Mono',monospace;overflow:hidden;cursor:pointer;transition:border-color .2s}
.ai-terminal:hover{border-color:rgba(0,255,65,.3)}
.ai-term-bar{background:#030903;border-bottom:1px solid rgba(0,255,65,.08);padding:8px 16px;display:flex;align-items:center;gap:6px}
.ai-dot{width:7px;height:7px;border-radius:50%}
.ai-dot-r{background:#FF5F57;opacity:.7}.ai-dot-y{background:#FFBD2E;opacity:.7}.ai-dot-g{background:#28C840;opacity:.7}
.ai-term-title{font-size:9px;letter-spacing:.1em;color:rgba(0,255,65,.3);margin-left:auto}
.ai-term-body{padding:20px}
.ai-cmd{font-size:9px;color:rgba(0,255,65,.4);margin-bottom:12px;letter-spacing:.05em}
.ai-cmd::before{content:'$ '}
.ai-ttl{font-size:clamp(14px,1.8vw,19px);color:#00FF41;line-height:1.4;margin-bottom:10px;font-weight:400}
.ai-ex{font-size:10px;color:rgba(0,255,65,.45);line-height:1.8}
.ai-tags{display:flex;gap:6px;flex-wrap:wrap;margin-top:12px}
.ai-tag{font-size:8px;letter-spacing:.1em;text-transform:uppercase;border:1px solid rgba(0,255,65,.2);padding:2px 8px;color:rgba(0,255,65,.5)}
.ai-loading{height:2px;background:rgba(0,255,65,.06);margin-top:14px;position:relative;overflow:hidden}
.ai-loading::after{content:'';position:absolute;top:0;height:100%;background:#00FF41;width:30%;animation:aiload 2.5s ease infinite}
@keyframes aiload{0%{left:-30%}100%{left:130%}}

/* CRYPTO */
.ns-crypto{background:#010803;padding:80px 5vw;position:relative}
.ns-crypto::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%,rgba(0,255,135,.04) 0%,transparent 60%)}
.cr-label{font-size:9px;letter-spacing:.3em;color:#00FF87;text-transform:uppercase;margin-bottom:8px;position:relative;z-index:1}
.cr-title{font-family:'Bebas Neue',cursive;font-size:clamp(56px,7vw,100px);color:#fff;line-height:.9;margin-bottom:48px;position:relative;z-index:1}
.cr-title span{color:#00FF87}
.cr-ticker-row{display:flex;gap:2px;margin-bottom:32px;position:relative;z-index:1;overflow-x:auto;scrollbar-width:none}
.cr-ticker-row::-webkit-scrollbar{display:none}
.cr-tick{background:#020D05;border:1px solid rgba(0,255,135,.1);padding:12px 20px;min-width:140px;flex-shrink:0}
.cr-t-sym{font-size:10px;letter-spacing:.1em;color:rgba(255,255,255,.4);margin-bottom:4px}
.cr-t-price{font-family:'DM Mono',monospace;font-size:18px;font-weight:500;color:#fff}
.cr-t-chg{font-size:10px;margin-top:2px}
.up{color:#00FF87}.down{color:#FF2D55}
.cr-grid{display:grid;grid-template-columns:2fr 1fr 1fr;gap:2px;background:rgba(0,255,135,.03);position:relative;z-index:1}
.cr-card{background:#010803;padding:24px;cursor:pointer;transition:background .2s}
.cr-card:hover{background:#021205}
.cr-card.main{border-left:3px solid #00FF87}
.cr-cat{font-size:8px;letter-spacing:.25em;color:#00FF87;text-transform:uppercase;margin-bottom:10px}
.cr-ttl{font-family:'Rajdhani',sans-serif;font-weight:700;font-size:clamp(18px,2.2vw,28px);color:#fff;line-height:1.2;margin-bottom:8px}
.cr-ex{font-size:10px;color:rgba(255,255,255,.35);line-height:1.7}
.cr-chart{height:40px;display:flex;align-items:flex-end;gap:2px;margin:12px 0}
.cr-bar{background:rgba(0,255,135,.25);border-radius:1px;transition:background .2s}
.cr-card:hover .cr-bar{background:rgba(0,255,135,.5)}
.cr-meta{font-size:9px;color:rgba(255,255,255,.2);display:flex;justify-content:space-between;padding-top:10px;border-top:1px solid rgba(0,255,135,.06)}

/* VIRAL */
.ns-viral{background:#050505;padding:80px 5vw;position:relative}
.vr-label{font-size:9px;letter-spacing:.3em;color:#FF6B00;text-transform:uppercase;margin-bottom:8px;position:relative;z-index:1}
.vr-title{font-family:'Bebas Neue',cursive;font-size:clamp(60px,9vw,130px);line-height:.88;position:relative;z-index:1;margin-bottom:48px}
.vr-title .c1{color:#FF6B00}
.vr-title .c2{color:#FFE600}
.vr-title .c3{color:#FF006E}
.vr-chaos{display:grid;grid-template-columns:repeat(12,1fr);grid-template-rows:auto;gap:3px;position:relative;z-index:1}
.vr-card{padding:20px;cursor:pointer;overflow:hidden;position:relative;transition:transform .2s}
.vr-card:hover{transform:scale(1.02)}
.vr-c1{grid-column:1/5;grid-row:1;background:#0F0500}
.vr-c2{grid-column:5/9;grid-row:1;background:#00050F}
.vr-c3{grid-column:9/13;grid-row:1;background:#0A000A}
.vr-c4{grid-column:1/4;grid-row:2;background:#050F00}
.vr-c5{grid-column:4/8;grid-row:2;background:#0F0500}
.vr-c6{grid-column:8/13;grid-row:2;background:#00050F}
.vr-badge{display:inline-flex;align-items:center;gap:5px;font-size:8px;letter-spacing:.12em;text-transform:uppercase;padding:3px 8px;margin-bottom:10px;border-radius:1px}
.vr-badge-fire{background:rgba(255,107,0,.15);color:#FF6B00;border:1px solid rgba(255,107,0,.25)}
.vr-badge-viral{background:rgba(255,0,110,.15);color:#FF006E;border:1px solid rgba(255,0,110,.25)}
.vr-badge-trend{background:rgba(255,230,0,.15);color:#FFE600;border:1px solid rgba(255,230,0,.25)}
.vr-ttl{font-family:'Barlow Condensed',sans-serif;font-size:clamp(15px,1.8vw,22px);font-weight:700;line-height:1.2;color:#fff;margin-bottom:8px}
.vr-num{font-family:'Bebas Neue',cursive;font-size:36px;color:rgba(255,255,255,.04);position:absolute;right:16px;bottom:8px}
.vr-meter{height:2px;background:rgba(255,255,255,.05);margin:10px 0;position:relative}
.vr-meter-fill{position:absolute;top:0;left:0;height:100%}
.vr-shares{font-size:9px;color:rgba(255,255,255,.25)}

/* APP BAND */
.app-band{background:#0A0A0F;padding:60px 5vw;border-top:1px solid rgba(255,255,255,.04);border-bottom:1px solid rgba(255,255,255,.04)}
.app-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2px}
.app-c{background:#0D0D15;padding:28px;border:1px solid rgba(255,255,255,.05);cursor:pointer;transition:all .2s;position:relative;overflow:hidden}
.app-c:hover{transform:translateY(-4px)}
.app-c::after{content:'';position:absolute;bottom:-40px;right:-40px;width:80px;height:80px;border-radius:50%;opacity:0;transition:opacity .3s}
.app-c.ac1::after{background:radial-gradient(circle,rgba(255,45,85,.15),transparent)}
.app-c.ac2::after{background:radial-gradient(circle,rgba(123,97,255,.12),transparent)}
.app-c.ac3::after{background:radial-gradient(circle,rgba(0,255,65,.1),transparent)}
.app-c.ac4::after{background:radial-gradient(circle,rgba(68,136,255,.12),transparent)}
.app-c.ac5::after{background:radial-gradient(circle,rgba(255,0,110,.12),transparent)}
.app-c.ac6::after{background:radial-gradient(circle,rgba(0,255,135,.1),transparent)}
.app-c:hover::after{opacity:1}
.app-ico{font-size:20px;margin-bottom:14px}
.app-nm{font-family:'Rajdhani',sans-serif;font-size:20px;font-weight:700;color:#fff;margin-bottom:6px}
.app-ds{font-size:10px;color:rgba(255,255,255,.35);line-height:1.7;margin-bottom:16px}
.app-lk{font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#fff;display:flex;align-items:center;gap:8px}
.app-lk::after{content:'→';transition:transform .2s}
.app-c:hover .app-lk::after{transform:translateX(4px)}

/* NEWSLETTER */
.nl-section{padding:80px 5vw;background:#000;text-align:center;position:relative;overflow:hidden}
.nl-section::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 50% 50%,rgba(255,45,85,.04) 0%,transparent 70%)}
.nl-inner{max-width:560px;margin:0 auto;position:relative;z-index:1}
.nl-kicker{font-size:9px;letter-spacing:.3em;color:#FF2D55;text-transform:uppercase;margin-bottom:16px}
.nl-h{font-family:'Bebas Neue',cursive;font-size:clamp(48px,7vw,88px);color:#fff;line-height:.9;margin-bottom:16px}
.nl-h span{-webkit-text-stroke:1px rgba(255,255,255,.15);color:transparent}
.nl-p{font-size:11px;color:rgba(255,255,255,.35);line-height:1.8;margin-bottom:32px}
.nl-row{display:flex}
.nl-in{flex:1;padding:14px 18px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-right:none;color:#fff;font-family:'DM Mono',monospace;font-size:12px;outline:none}
.nl-in:focus{border-color:rgba(255,45,85,.4)}
.nl-in::placeholder{color:rgba(255,255,255,.25)}
.nl-bt{padding:14px 28px;background:#FF2D55;color:#000;border:none;cursor:pointer;font-family:'DM Mono',monospace;font-size:10px;letter-spacing:.15em;text-transform:uppercase}
.nl-note{font-size:9px;color:rgba(255,255,255,.2);margin-top:12px;letter-spacing:.06em}

/* FOOTER */
footer{background:#030305;padding:48px 5vw 28px;border-top:1px solid rgba(255,255,255,.05)}
.ft-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:48px;margin-bottom:40px}
.ft-logo{font-family:'Bebas Neue',cursive;font-size:28px;letter-spacing:.08em;color:#fff;margin-bottom:10px}
.ft-logo span{color:#FF2D55}
.ft-tag{font-size:10px;color:rgba(255,255,255,.3);line-height:1.7}
.ft-col-h{font-size:8px;letter-spacing:.25em;color:#FF2D55;text-transform:uppercase;margin-bottom:14px}
.ft-links{list-style:none;display:flex;flex-direction:column;gap:8px}
.ft-links a{font-size:11px;color:rgba(255,255,255,.3);text-decoration:none;transition:color .2s}
.ft-links a:hover{color:#fff}
.ft-bottom{display:flex;justify-content:space-between;border-top:1px solid rgba(255,255,255,.04);padding-top:24px;font-size:9px;color:rgba(255,255,255,.2)}
.ft-social{display:flex;gap:16px}
.ft-social a{font-size:9px;letter-spacing:.15em;color:rgba(255,255,255,.2);text-decoration:none;transition:color .2s}
.ft-social a:hover{color:#FF2D55}

.reveal{opacity:0;transform:translateY(36px);transition:opacity .7s ease,transform .7s ease}
.reveal.on{opacity:1;transform:none}

@media(max-width:1024px){
.hh-grid{grid-template-columns:1fr 1fr}
.hh-card.main{grid-column:1/3;grid-row:auto}
.inf-phones{grid-template-columns:repeat(2,1fr)}
.inf-phone:nth-child(2),.inf-phone:nth-child(3){transform:none}
.vr-chaos{grid-template-columns:repeat(6,1fr)}
.vr-c1,.vr-c2,.vr-c3,.vr-c4,.vr-c5,.vr-c6{grid-column:auto;grid-row:auto}
}

@media(max-width:768px){
.v-nav{bottom:0;top:auto;left:0;right:0;width:100%;height:56px;flex-direction:row;padding:0 16px;justify-content:space-around}
.v-logo,.v-divider,.v-live{display:none}
.v-links{flex-direction:row;width:auto;gap:8px}
.v-tooltip{display:none}
main{margin-left:0;margin-bottom:56px}
.hh-grid,.mv-row,.st-grid,.cr-grid,.app-grid{grid-template-columns:1fr}
.hero-bottom{flex-direction:column;align-items:flex-start;gap:24px}
.nl-row{flex-direction:column}
.nl-in{border-right:1px solid rgba(255,255,255,.08);margin-bottom:8px}
.ft-grid{grid-template-columns:1fr 1fr;gap:32px}
.ai-grid{grid-template-columns:1fr}
.st-header{grid-template-columns:1fr;gap:16px}
}
</style>
</head>
<body>

<div id="cur"></div>
<div id="cur-r"></div>

<nav class="v-nav">
  <div class="v-logo">Buzz<span>Wire</span></div>
  <div class="v-divider"></div>
  <div class="v-links">
    <div class="v-link active">🎤<div class="v-tooltip">Urban</div></div>
    <div class="v-link">🎬<div class="v-tooltip">Films</div></div>
    <div class="v-link">📺<div class="v-tooltip">Stream</div></div>
    <div class="v-link">🌟<div class="v-tooltip">Creators</div></div>
    <div class="v-link">🤖<div class="v-tooltip">AI Lab</div></div>
    <div class="v-link">₿<div class="v-tooltip">Crypto</div></div>
    <div class="v-link">📱<div class="v-tooltip">Viral</div></div>
  </div>
  <div class="v-live"><div class="v-dot"></div><span style="writing-mode:vertical-rl;font-size:7px;letter-spacing:.2em">LIVE</span></div>
</nav>

<main>
<section class="hero">
  <canvas id="hero-canvas"></canvas>
  <div class="hero-eyebrow">Signal Active — Apr 05 2026</div>
  <h1 class="hero-h1"><span class="outline">VOID</span><br><span class="red">SIGNAL</span><br>DAILY</h1>
  <div class="hero-bottom">
    <p class="hero-desc">Hip-hop. AI. Crypto. Streaming. Virality.<br>Built for the generation that doesn't wait for tomorrow.</p>
    <button class="hero-btn">Enter the Wire →</button>
  </div>
  <div class="hero-scroll"><div class="h-scroll-line"></div>SCROLL</div>
</section>

<div class="ticker">
  <div class="ticker-wrap">
    <span class="t-item">Kendrick Lamar confirms Q2 LP</span>
    <span class="t-item">GPT-5 passes Turing benchmark</span>
    <span class="t-item">Netflix Q1 beats estimates +$800M</span>
    <span class="t-item">BTC ETF inflows $4.2B single day</span>
    <span class="t-item">Drake 60-city world tour confirmed</span>
    <span class="t-item">TikTok algo wipes 40% creator reach</span>
    <span class="t-item">$AGNT token +380% in 48 hours</span>
    <span class="t-item">Peaky Blinders film begins production</span>
    <span class="t-item">Kendrick Lamar confirms Q2 LP</span>
    <span class="t-item">GPT-5 passes Turing benchmark</span>
    <span class="t-item">Netflix Q1 beats estimates +$800M</span>
    <span class="t-item">BTC ETF inflows $4.2B single day</span>
    <span class="t-item">Drake 60-city world tour confirmed</span>
    <span class="t-item">TikTok algo wipes 40% creator reach</span>
    <span class="t-item">$AGNT token +380% in 48 hours</span>
    <span class="t-item">Peaky Blinders film begins production</span>
  </div>
</div>

<!-- HIP-HOP -->
<section class="ns ns-hiphop reveal">
  <div class="hh-header">
    <div class="hh-label">Section 01 — Urban Culture</div>
    <h2 class="hh-title"><span class="white">HIP</span><br>HOP<br><span class="white">& URBAN</span></h2>
    <p class="hh-sub">// Beats. Culture. Streets. Truth.</p>
  </div>
  <div class="hh-grid">
    <div class="hh-card main">
      <div class="hh-big-num">01</div>
      <div class="hh-cat">🔥 Exclusive</div>
      <h3 class="hh-ttl">The AI-Generated Rap Problem: How Bots Are Gaming the Charts & What Artists Are Doing About It</h3>
      <p class="hh-ex">A deep investigation into bot-driven stream manipulation — and the artists fighting back with raw authenticity. The underground response is building...</p>
      <div class="freq-bar">
        <div class="freq-b" style="height:20px"></div><div class="freq-b" style="height:26px"></div><div class="freq-b" style="height:16px"></div>
        <div class="freq-b" style="height:28px"></div><div class="freq-b" style="height:22px"></div><div class="freq-b" style="height:18px"></div><div class="freq-b" style="height:24px"></div>
      </div>
      <div class="hh-meta"><span>Marcus Webb · 8 min</span><span class="hh-fire">🔥 42K shares</span></div>
    </div>
    <div class="hh-card">
      <div class="hh-big-num">02</div><div class="hh-cat">Rap Culture</div>
      <h3 class="hh-ttl">Kdot × Pharrell: The Collab Redefining West Coast Sound</h3>
      <p class="hh-ex">Studio sessions confirmed since February. Sources say the sound is "nothing like either of them separately."</p>
      <div class="hh-meta"><span>5 min</span><span class="up">Trending</span></div>
    </div>
    <div class="hh-card">
      <div class="hh-big-num">03</div><div class="hh-cat">R&B</div>
      <h3 class="hh-ttl">SZA's Unreleased Vault: Everything We Know About LANA II</h3>
      <p class="hh-ex">Feature confirmations, production credits, and why this could be her most personal work.</p>
      <div class="hh-meta"><span>4 min</span><span style="color:#FFE600">Hot</span></div>
    </div>
    <div class="hh-card">
      <div class="hh-big-num">04</div><div class="hh-cat">Celebrity</div>
      <h3 class="hh-ttl">Travis Scott's $40M Utopia II Tour Stage Production Specs Revealed</h3>
      <div class="hh-meta"><span>3 min</span><span>Industry</span></div>
    </div>
    <div class="hh-card">
      <div class="hh-big-num">05</div><div class="hh-cat">Battle Rap</div>
      <h3 class="hh-ttl">Battle Rap Leagues Thrive While Labels Struggle — The Numbers Tell a Story</h3>
      <div class="hh-meta"><span>6 min</span><span class="hh-fire">Breaking</span></div>
    </div>
  </div>
</section>

<!-- MOVIES -->
<section class="ns ns-movies reveal">
  <div class="film-grain"></div>
  <div class="film-strip-l"><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div><div class="sprocket"></div></div>
  <div class="movies-content">
    <div class="mv-label">Section 02 — Cinema & Television</div>
    <h2 class="mv-title">Movies<br>& <span>TV</span></h2>
    <div class="mv-row">
      <div class="mv-card"><div class="mv-frame"><div class="mv-img" style="background:linear-gradient(135deg,#0a0010,#1a0a00)"></div><div class="mv-lb-top"></div><div class="mv-lb-bot"></div></div><div class="mv-card-body"><div class="mv-score">★★★★½ — Critic Pick</div><h3 class="mv-ttl">Peaky Blinders: The Feature Film — Everything We Know About the Production</h3><p class="mv-ex">Cillian Murphy confirmed. 1920s Birmingham. A story the series couldn't tell in six seasons. Production begins April 2026...</p><div class="mv-meta"><span>Film News</span><span>6 min</span><span style="color:#8B1A1A">Exclusive</span></div></div></div>
      <div class="mv-card"><div class="mv-frame"><div class="mv-img" style="background:linear-gradient(135deg,#000814,#001a14)"></div><div class="mv-lb-top"></div><div class="mv-lb-bot"></div></div><div class="mv-card-body"><div class="mv-score">Anime — Rising</div><h3 class="mv-ttl">Why Anime Is Outselling Hollywood at the Global Box Office in 2026</h3><p class="mv-ex">The data is undeniable. Three of the top five global box office films this quarter are anime productions...</p><div class="mv-meta"><span>Analysis</span><span>8 min</span></div></div></div>
      <div class="mv-card"><div class="mv-frame"><div class="mv-img" style="background:linear-gradient(135deg,#100005,#00050f)"></div><div class="mv-lb-top"></div><div class="mv-lb-bot"></div></div><div class="mv-card-body"><div class="mv-score">Streaming</div><h3 class="mv-ttl">Netflix Cancellation Pattern: The Algorithm Killing Prestige TV Before Season 3</h3><p class="mv-ex">We analyzed 200 cancelled shows. The formula emerges — and it has nothing to do with quality...</p><div class="mv-meta"><span>Industry</span><span>10 min</span></div></div></div>
    </div>
  </div>
</section>

<!-- STREAMING -->
<section class="ns ns-stream reveal">
  <div class="st-header">
    <div><div class="st-label">Section 03 — Streaming Wars</div><h2 class="st-title">THE <span>STREAM</span><br>WARS</h2></div>
    <div class="st-status">● 5 platforms · 1 winner</div>
  </div>
  <div class="st-grid">
    <div class="st-card"><div class="st-platforms"><span class="plt plt-nf">Netflix</span><span class="plt plt-di">Disney+</span></div><h3 class="st-ttl">Netflix vs Disney+: The Q1 2026 Subscriber War Just Got Ugly</h3><p class="st-ex">Netflix posted +8M subs while Disney+ lost 3M in the same quarter. The content strategy divergence is now critical mass...</p><div class="st-bar"><div class="st-bar-fill" style="width:78%"></div></div><div class="st-meta"><span>Trending 78%</span><span>7 min</span></div></div>
    <div class="st-card"><div class="st-platforms"><span class="plt plt-pr">Prime</span><span class="plt plt-fr">Free</span></div><h3 class="st-ttl">The 5 Best Free Streaming Alternatives Cord-Cutters Are Hiding</h3><p class="st-ex">Tubi, Pluto, Peacock Free, Plex, and one platform most people have never heard of...</p><div class="st-bar"><div class="st-bar-fill" style="width:65%;background:#00FF87"></div></div><div class="st-meta"><span>Guide</span><span>5 min</span></div></div>
    <div class="st-card"><div class="st-platforms"><span class="plt plt-hb">Max</span><span class="plt plt-nf">Netflix</span></div><h3 class="st-ttl">Which Streaming Bundle Is Actually Worth It in 2026? We Did the Math</h3><p class="st-ex">Price hikes hit four platforms in Q1. We modeled 12 bundle scenarios against actual watch-time data...</p><div class="st-bar"><div class="st-bar-fill" style="width:91%;background:#FFD700"></div></div><div class="st-meta"><span>Hot 91%</span><span>9 min</span></div></div>
  </div>
</section>

<!-- INFLUENCERS -->
<section class="ns ns-inf reveal">
  <div class="inf-label">Section 04 — Creators & Influencers</div>
  <h2 class="inf-title"><span class="hot">CREATOR</span><br><span class="cold">ECON</span><br>OMY</h2>
  <div class="inf-phones">
    <div class="inf-phone"><div class="inf-phone-screen"><div class="inf-screen-bg" style="background:linear-gradient(180deg,#1a0030,#050008)"></div><div class="inf-notch"></div><div class="inf-stats"><span class="inf-stat-chip" style="color:#FF006E">2.4M views</span><span class="inf-stat-chip" style="color:#00D9FF">94% eng</span></div></div><div class="inf-body"><div class="inf-creator">@creator_economy</div><div class="inf-ttl">69% of Creators Report Financial Instability in 2026</div><div class="inf-eng"><span>12K</span> shares · <span>340K</span> views</div></div></div>
    <div class="inf-phone"><div class="inf-phone-screen"><div class="inf-screen-bg" style="background:linear-gradient(180deg,#001a30,#000508)"></div><div class="inf-notch"></div><div class="inf-stats"><span class="inf-stat-chip" style="color:#00D9FF">TikTok</span><span class="inf-stat-chip" style="color:#FF006E">Breaking</span></div></div><div class="inf-body"><div class="inf-creator">@algo_watch</div><div class="inf-ttl">TikTok's Algorithm 4.0 Just Wiped 40% of Reach Overnight</div><div class="inf-eng"><span>8.2K</span> shares · <span>240K</span> views</div></div></div>
    <div class="inf-phone"><div class="inf-phone-screen"><div class="inf-screen-bg" style="background:linear-gradient(180deg,#1a1000,#050300)"></div><div class="inf-notch"></div><div class="inf-stats"><span class="inf-stat-chip" style="color:#FFD700">Finance</span><span class="inf-stat-chip" style="color:#FF006E">Tool</span></div></div><div class="inf-body"><div class="inf-creator">@brand_deals</div><div class="inf-ttl">Brand Deals Are Getting Worse — Here's How to Negotiate Back</div><div class="inf-eng"><span>6.1K</span> shares · <span>180K</span> views</div></div></div>
    <div class="inf-phone"><div class="inf-phone-screen"><div class="inf-screen-bg" style="background:linear-gradient(180deg,#001a0a,#000508)"></div><div class="inf-notch"></div><div class="inf-stats"><span class="inf-stat-chip" style="color:#00D9FF">African</span><span class="inf-stat-chip" style="color:#39FF14">Rising</span></div></div><div class="inf-body"><div class="inf-creator">@afrocreator</div><div class="inf-ttl">Nigerian Creators Are the Fastest Growing Influencer Market Globally</div><div class="inf-eng"><span>9.8K</span> shares · <span>290K</span> views</div></div></div>
  </div>
</section>

<!-- AI -->
<section class="ns ns-ai reveal">
  <div class="ai-header"><div class="ai-prompt">initialize ai_lab module — buzzwire_daily v2.6</div><h2 class="ai-title">AI LAB</h2></div>
  <div class="ai-grid">
    <div class="ai-terminal"><div class="ai-term-bar"><div class="ai-dot ai-dot-r"></div><div class="ai-dot ai-dot-y"></div><div class="ai-dot ai-dot-g"></div><div class="ai-term-title">analysis_01.sh</div></div><div class="ai-term-body"><div class="ai-cmd">run --compare claude gpt-5 gemini --mode honest</div><h3 class="ai-ttl">Claude vs GPT-5 vs Gemini 2.5: The Honest 2026 Tier List After 200hrs of Testing</h3><p class="ai-ex">We ran 847 standardized prompts across coding, reasoning, creativity, and factual accuracy. The results contradict the marketing...</p><div class="ai-tags"><span class="ai-tag">review</span><span class="ai-tag">comparison</span><span class="ai-tag">12 min</span></div><div class="ai-loading"></div></div></div>
    <div class="ai-terminal"><div class="ai-term-bar"><div class="ai-dot ai-dot-r"></div><div class="ai-dot ai-dot-y"></div><div class="ai-dot ai-dot-g"></div><div class="ai-term-title">subscriptions.log</div></div><div class="ai-term-body"><div class="ai-cmd">audit --user-subs --find-overlap --output=savings</div><h3 class="ai-ttl">You're Paying $64/Month for 7 AI Subscriptions — And 4 Do the Same Thing</h3><p class="ai-ex">The quiet cost creep hitting power users: ChatGPT Plus, Claude Pro, Gemini Advanced, Perplexity Pro — overlapping at 73%...</p><div class="ai-tags"><span class="ai-tag">finance</span><span class="ai-tag">5 min</span></div><div class="ai-loading"></div></div></div>
    <div class="ai-terminal"><div class="ai-term-bar"><div class="ai-dot ai-dot-r"></div><div class="ai-dot ai-dot-y"></div><div class="ai-dot ai-dot-g"></div><div class="ai-term-title">music_tools.sh</div></div><div class="ai-term-body"><div class="ai-cmd">test --ai-music --blind --judges=50producers</div><h3 class="ai-ttl">AI Music Production Tools Ranked: Which Actually Sound Human in a Blind Test?</h3><p class="ai-ex">We fed 6 tools the same 16-bar prompt. 50 producers voted blind. The winner surprised everyone — including us...</p><div class="ai-tags"><span class="ai-tag">music</span><span class="ai-tag">hip-hop</span><span class="ai-tag">8 min</span></div><div class="ai-loading"></div></div></div>
    <div class="ai-terminal"><div class="ai-term-bar"><div class="ai-dot ai-dot-r"></div><div class="ai-dot ai-dot-y"></div><div class="ai-dot ai-dot-g"></div><div class="ai-term-title">gaming_agents.log</div></div><div class="ai-term-body"><div class="ai-cmd">analyze --ai-npc --behavior=adaptive --realtime</div><h3 class="ai-ttl">AI NPCs Are Destroying Game Balance in Real Time — And Players Are Obsessed</h3><p class="ai-ex">Adaptive enemy intelligence that learns your playstyle between sessions. The future of single-player is already here...</p><div class="ai-tags"><span class="ai-tag">gaming</span><span class="ai-tag">web3</span><span class="ai-tag">7 min</span></div><div class="ai-loading"></div></div></div>
  </div>
</section>

<!-- CRYPTO -->
<section class="ns ns-crypto reveal">
  <div class="cr-label">Section 06 — Crypto & Web3</div>
  <h2 class="cr-title">CRYPTO<br>& <span>WEB3</span></h2>
  <div class="cr-ticker-row">
    <div class="cr-tick"><div class="cr-t-sym">BTC</div><div class="cr-t-price">$94,230</div><div class="cr-t-chg up">▲ +4.2%</div></div>
    <div class="cr-tick"><div class="cr-t-sym">ETH</div><div class="cr-t-price">$3,841</div><div class="cr-t-chg up">▲ +2.8%</div></div>
    <div class="cr-tick"><div class="cr-t-sym">SOL</div><div class="cr-t-price">$187.40</div><div class="cr-t-chg up">▲ +6.1%</div></div>
    <div class="cr-tick"><div class="cr-t-sym">$AGNT</div><div class="cr-t-price">$0.0842</div><div class="cr-t-chg up">▲ +380%</div></div>
    <div class="cr-tick"><div class="cr-t-sym">BNB</div><div class="cr-t-price">$612.20</div><div class="cr-t-chg down">▼ −1.1%</div></div>
    <div class="cr-tick"><div class="cr-t-sym">LINK</div><div class="cr-t-price">$22.40</div><div class="cr-t-chg up">▲ +3.3%</div></div>
  </div>
  <div class="cr-grid">
    <div class="cr-card main"><div class="cr-cat">🔥 Featured Analysis</div><h3 class="cr-ttl">Bitcoin at $94K: On-Chain Data Points to $110K — The Signal Institutional Holders Are Sending</h3><p class="cr-ex">Long-term holder accumulation at levels not seen since the 2020 pre-rally. Three on-chain metrics flashing historically rare bullish divergence. Here's what the data actually means for the next 90 days...</p><div class="cr-chart"><div class="cr-bar" style="height:60%;width:6px"></div><div class="cr-bar" style="height:45%;width:6px"></div><div class="cr-bar" style="height:70%;width:6px"></div><div class="cr-bar" style="height:55%;width:6px"></div><div class="cr-bar" style="height:80%;width:6px"></div><div class="cr-bar" style="height:65%;width:6px"></div><div class="cr-bar" style="height:90%;width:6px"></div><div class="cr-bar" style="height:75%;width:6px"></div><div class="cr-bar" style="height:100%;width:6px;background:#00FF87"></div></div><div class="cr-meta"><span>Research · 9 min</span><span class="up">+42K views today</span></div></div>
    <div class="cr-card"><div class="cr-cat">AI × Crypto</div><h3 class="cr-ttl">AI Agent Tokens: 5 Projects with Real Utility in 2026</h3><p class="cr-ex">Beyond the hype — a utility-first deep dive into the top AI-adjacent crypto plays that might actually survive the cycle.</p><div class="cr-meta"><span>Research · 9 min</span><span class="up">Trending</span></div></div>
    <div class="cr-card"><div class="cr-cat">Tax Guide</div><h3 class="cr-ttl">2026 Crypto Tax Rules: The IRS Changes Every Holder Must Know</h3><p class="cr-ex">New cost basis reporting requirements. What changed, what didn't, and how to stay compliant without paying more than you owe.</p><div class="cr-meta"><span>Finance · 10 min</span><span class="down">Action Required</span></div></div>
  </div>
</section>

<!-- VIRAL -->
<section class="ns ns-viral reveal">
  <div class="vr-label">Section 07 — Viral & Social</div>
  <h2 class="vr-title"><span class="c1">VIRAL</span><br><span class="c2">&</span><br><span class="c3">SOCIAL</span></h2>
  <div class="vr-chaos">
    <div class="vr-card vr-c1"><div class="vr-badge vr-badge-fire">🔥 12K shares</div><h3 class="vr-ttl">TikTok's Algorithm Wipe: 40% Reach Loss Overnight — What You Must Do Now</h3><div class="vr-meter"><div class="vr-meter-fill" style="width:92%;background:#FF6B00"></div></div><div class="vr-shares">Virality: 92 / 100</div><div class="vr-num">01</div></div>
    <div class="vr-card vr-c2"><div class="vr-badge vr-badge-viral">📱 8.4K shares</div><h3 class="vr-ttl">Instagram's New Chronological Feed is Already Being Gamed — Here's How</h3><div class="vr-meter"><div class="vr-meter-fill" style="width:78%;background:#FF006E"></div></div><div class="vr-shares">Virality: 78 / 100</div><div class="vr-num">02</div></div>
    <div class="vr-card vr-c3"><div class="vr-badge vr-badge-trend">✦ Trending</div><h3 class="vr-ttl">The POV Format Is Dead. Here's What Gen Z Is Watching Instead</h3><div class="vr-meter"><div class="vr-meter-fill" style="width:65%;background:#FF006E"></div></div><div class="vr-shares">Virality: 65 / 100</div><div class="vr-num">03</div></div>
    <div class="vr-card vr-c4"><div class="vr-badge vr-badge-fire">🔥 Creator</div><h3 class="vr-ttl">X's New Monetization Policy Pays 3× More — But Only If You Do This</h3><div class="vr-meter"><div class="vr-meter-fill" style="width:85%;background:#FF6B00"></div></div><div class="vr-shares">Virality: 85 / 100</div></div>
    <div class="vr-card vr-c5"><div class="vr-badge vr-badge-trend">YouTube</div><h3 class="vr-ttl">YouTube Shorts Is Paying Creators 4× More Than TikTok Per View Now</h3><div class="vr-meter"><div class="vr-meter-fill" style="width:71%;background:#FFE600"></div></div><div class="vr-shares">Virality: 71 / 100</div></div>
    <div class="vr-card vr-c6"><div class="vr-badge vr-badge-viral">🕹 Gaming</div><h3 class="vr-ttl">How a 19-Year-Old Gamer Hit 10M Followers in 60 Days With One Strategy</h3><div class="vr-meter"><div class="vr-meter-fill" style="width:88%;background:#FF006E"></div></div><div class="vr-shares">Virality: 88 / 100</div></div>
  </div>
</section>

<!-- APP BAND -->
<section class="app-band reveal">
  <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:32px">
    <div><div style="font-size:9px;letter-spacing:.3em;color:#FF2D55;text-transform:uppercase;margin-bottom:8px">Built-in Tools</div><h2 style="font-family:'Bebas Neue',cursive;font-size:clamp(40px,5vw,64px);color:#fff">Apps That <span style="color:#FF2D55">Solve</span> Problems</h2></div>
    <a href="#" style="font-size:9px;letter-spacing:.2em;color:rgba(255,255,255,.3);text-decoration:none;text-transform:uppercase">All 14 Apps →</a>
  </div>
  <div class="app-grid">
    <div class="app-c ac1"><div class="app-ico">💡</div><div class="app-nm">Hook Tester</div><p class="app-ds">Paste any caption or headline. Get virality score + why it works. Cross-niche, free.</p><span class="app-lk">Try Free</span></div>
    <div class="app-c ac2"><div class="app-ico">📺</div><div class="app-nm">WhereToWatch</div><p class="app-ds">Any title, every platform, including free options. The tool everyone needs.</p><span class="app-lk">Find It Now</span></div>
    <div class="app-c ac3"><div class="app-ico">₿</div><div class="app-nm">Token Truth</div><p class="app-ds">Paste any contract. Get utility score, red flags, and whale activity instantly.</p><span class="app-lk">Analyze</span></div>
    <div class="app-c ac4"><div class="app-ico">🤖</div><div class="app-nm">AI Tool Match</div><p class="app-ds">Tell us what you need. Get AI tools that actually work — no affiliate bias.</p><span class="app-lk">Match Me</span></div>
    <div class="app-c ac5"><div class="app-ico">🎵</div><div class="app-nm">Stream Truth</div><p class="app-ds">Detect bot-driven streams vs real engagement on any Spotify link.</p><span class="app-lk">Detect Bots</span></div>
    <div class="app-c ac6"><div class="app-ico">🔔</div><div class="app-nm">Drop Alert</div><p class="app-ds">Follow artists. Get notified before the official release — sometimes hours early.</p><span class="app-lk">Follow</span></div>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="nl-section reveal">
  <div class="nl-inner">
    <div class="nl-kicker">Daily Brief</div>
    <h2 class="nl-h">Stay on the <span>Wire</span></h2>
    <p class="nl-p">One daily signal. Hip-hop, AI, crypto, streaming, virality — curated for the generation that moves fast.</p>
    <div class="nl-row"><input class="nl-in" type="email" placeholder="your@email.com"><button class="nl-bt">Join →</button></div>
    <p class="nl-note">50,000+ readers · No spam · Unsubscribe anytime</p>
  </div>
</section>

<footer>
  <div class="ft-grid">
    <div><div class="ft-logo">Buzz<span>Wire</span> Daily</div><p class="ft-tag">Where culture breaks first. Multi-niche content platform built for the generation that doesn't wait.</p></div>
    <div><div class="ft-col-h">Sections</div><ul class="ft-links"><li><a href="#">🎤 Urban Culture</a></li><li><a href="#">🎬 Movies & TV</a></li><li><a href="#">📺 Streaming</a></li><li><a href="#">🌟 Creators</a></li><li><a href="#">🤖 AI Lab</a></li><li><a href="#">₿ Crypto</a></li><li><a href="#">📱 Viral</a></li></ul></div>
    <div><div class="ft-col-h">Apps</div><ul class="ft-links"><li><a href="#">Hook Tester</a></li><li><a href="#">WhereToWatch</a></li><li><a href="#">AI Tool Match</a></li><li><a href="#">Token Truth</a></li><li><a href="#">Stream Truth</a></li><li><a href="#">Drop Alert</a></li></ul></div>
    <div><div class="ft-col-h">Company</div><ul class="ft-links"><li><a href="#">About</a></li><li><a href="#">Advertise</a></li><li><a href="#">Newsletter</a></li><li><a href="#">Privacy</a></li><li><a href="#">Contact</a></li></ul></div>
  </div>
  <div class="ft-bottom"><span>© 2026 Buzzwire Daily · Powered by OpenWork</span><div class="ft-social"><a href="#">TikTok</a><a href="#">X</a><a href="#">Instagram</a><a href="#">YouTube</a></div></div>
</footer>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
// CURSOR
const cur=document.getElementById('cur'),ring=document.getElementById('cur-r');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;cur.style.left=(mx-4)+'px';cur.style.top=(my-4)+'px'});
(function anim(){rx+=(mx-rx)*.1;ry+=(my-ry)*.1;ring.style.left=(rx-16)+'px';ring.style.top=(ry-16)+'px';requestAnimationFrame(anim)})();
document.querySelectorAll('a,button,.hh-card,.mv-card,.st-card,.inf-phone,.ai-terminal,.cr-card,.vr-card,.app-c,.v-link').forEach(el=>{el.addEventListener('mouseenter',()=>{cur.style.transform='scale(2.5)';ring.style.width='52px';ring.style.height='52px'});el.addEventListener('mouseleave',()=>{cur.style.transform='scale(1)';ring.style.width='32px';ring.style.height='32px'})});

// HERO 3D
(function(){
  const canvas=document.getElementById('hero-canvas');
  const renderer=new THREE.WebGLRenderer({canvas,alpha:true,antialias:true});
  renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));
  renderer.setSize(canvas.offsetWidth,canvas.offsetHeight);
  const scene=new THREE.Scene();
  const cam=new THREE.PerspectiveCamera(45,canvas.offsetWidth/canvas.offsetHeight,.1,100);
  cam.position.set(0,0,6);
  const geo=new THREE.IcosahedronGeometry(2,5);
  const mat=new THREE.MeshStandardMaterial({color:0xFF2D55,wireframe:true,transparent:true,opacity:.08});
  const sphere=new THREE.Mesh(geo,mat);sphere.position.set(3.5,.5,0);scene.add(sphere);
  const rGeo=new THREE.TorusGeometry(3,.5,4,48);
  const rMat=new THREE.MeshStandardMaterial({color:0x7B61FF,wireframe:true,transparent:true,opacity:.06});
  const ring3=new THREE.Mesh(rGeo,rMat);ring3.position.set(3.5,.5,0);ring3.rotation.x=Math.PI*.3;scene.add(ring3);
  const iGeo=new THREE.IcosahedronGeometry(1,3);
  const iMat=new THREE.MeshStandardMaterial({color:0xFFE600,wireframe:true,transparent:true,opacity:.15});
  const inner=new THREE.Mesh(iGeo,iMat);inner.position.set(3.5,.5,0);scene.add(inner);
  const pG=new THREE.BufferGeometry();const pArr=new Float32Array(1500*3);
  for(let i=0;i<1500*3;i++)pArr[i]=(Math.random()-.5)*18;
  pG.setAttribute('position',new THREE.BufferAttribute(pArr,3));
  const pM=new THREE.PointsMaterial({color:0xffffff,size:.012,transparent:true,opacity:.25});
  scene.add(new THREE.Points(pG,pM));
  scene.add(new THREE.AmbientLight(0xffffff,.4));
  const pl=new THREE.PointLight(0xFF2D55,3,20);pl.position.set(4,3,3);scene.add(pl);
  const pl2=new THREE.PointLight(0x7B61FF,2,15);pl2.position.set(-3,-2,1);scene.add(pl2);
  const pl3=new THREE.PointLight(0xFFE600,1.5,12);pl3.position.set(0,4,2);scene.add(pl3);
  const orig=geo.attributes.position.array.slice();const pos=geo.attributes.position;
  let t=0,mmx=0,mmy=0;
  document.addEventListener('mousemove',e=>{mmx=(e.clientX/window.innerWidth-.5)*2;mmy=-(e.clientY/window.innerHeight-.5)*2});
  function render(){requestAnimationFrame(render);t+=.005;
    for(let i=0;i<pos.count;i++){const ox=orig[i*3],oy=orig[i*3+1],oz=orig[i*3+2];const n=Math.sin(ox*1.8+t)*Math.cos(oy*1.8+t)*.18;pos.array[i*3]=ox+ox*n;pos.array[i*3+1]=oy+oy*n;pos.array[i*3+2]=oz+oz*n}
    pos.needsUpdate=true;geo.computeVertexNormals();
    sphere.rotation.x=t*.07+mmy*.15;sphere.rotation.y=t*.1+mmx*.15;ring3.rotation.y=t*.05;ring3.rotation.z=t*.03;inner.rotation.x=-t*.12;inner.rotation.y=t*.18;renderer.render(scene,cam)}render();
  window.addEventListener('resize',()=>{const w=canvas.offsetWidth,h=canvas.offsetHeight;renderer.setSize(w,h);cam.aspect=w/h;cam.updateProjectionMatrix()});
})();
