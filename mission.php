<?php
include('admin/inc/function.php');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mission - Mintova</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/mintova/tailwind.min.css" />
  <style>
    body { font-family: 'Inter', sans-serif; }

    #mobileMenu {
      position: fixed; top: 0; left: 0;
      width: 260px; height: 100%;
      background: rgba(10,10,10,0.96);
      border-right: 1px solid rgba(255,255,255,0.05);
      backdrop-filter: blur(12px);
      padding: 26px 22px;
      display: flex; flex-direction: column;
      z-index: 1001;
      transform: translateX(-100%);
      transition: transform .28s ease;
    }
    body.menu-open #mobileMenu { transform: translateX(0%); }

    #menuOverlay {
      position: fixed; inset: 0;
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(6px);
      z-index: 1000;
      pointer-events: none; opacity: 0;
      transition: opacity .28s ease;
    }
    body.menu-open #menuOverlay { opacity: 1; pointer-events: auto; }

    @media (min-width: 780px) {
      #mobileMenu, #menuOverlay { display: none; }
    }

    .mn-section { position: relative; padding: 60px 0; z-index: 1; }
    .mn-section:nth-of-type(odd)  { background: rgba(0,0,0,0.25); }
    .mn-section:nth-of-type(even) { background: rgba(255,255,255,0.02); }
    .mn-section::before, .mn-section::after {
      content: ""; position: absolute; left: 0; width: 100%; height: 1px;
      background: linear-gradient(90deg, transparent, rgba(251,146,60,0.15), transparent);
    }
    .mn-section::before { top: 0; }
    .mn-section::after  { bottom: 0; }
  </style>
</head>
<body class="bg-black text-white overflow-x-hidden">

<?php include('menu.php'); ?>

<!-- Mission Section -->
<section id="mission" class="mn-section max-w-6xl mx-auto px-6 py-16">
  <span class="px-5 py-1 bg-orange-400/20 text-orange-300 text-xs font-bold rounded-full tracking-wide">
    OUR MISSION
  </span>

  <h2 class="text-3xl md:text-4xl font-extrabold mt-5 mb-4">
    Empowering People With Smarter Digital Earnings
  </h2>

  <p class="text-gray-300 text-lg leading-relaxed max-w-3xl">
    Mintova's mission is to make digital earnings simple, safe, and accessible for everyone.
    We believe earning online shouldn't be complicated — it should be transparent, reliable,
    and rewarding every single day.
  </p>

  <div class="grid md:grid-cols-2 gap-6 mt-10">
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">1. Financial Accessibility</h4>
      <p class="text-gray-300 text-sm">We built Mintova so anyone — even with just INR 10 — can start earning daily without needing trading knowledge or financial expertise.</p>
    </div>
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">2. Transparent Earning System</h4>
      <p class="text-gray-300 text-sm">All ROI, tasks, and reward structures are clearly defined so users always know how and what they earn in real-time.</p>
    </div>
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">3. Global Opportunity</h4>
      <p class="text-gray-300 text-sm">Our mission is to build a worldwide community where people from any country can earn consistently with ease.</p>
    </div>
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">4. Long-Term Stability</h4>
      <p class="text-gray-300 text-sm">We focus on sustainable growth structures, stable income models, and future-ready earning methods to ensure Mintova lasts for the long run.</p>
    </div>
  </div>

  <div class="mt-10 p-6 bg-white/5 border border-white/10 rounded-xl">
    <h3 class="text-xl font-bold mb-3">A Mission With Real Purpose</h3>
    <p class="text-gray-300 text-sm leading-relaxed">
      Mintova isn't just a platform — it's a movement. A movement to give people a simple way to earn,
      a global platform to grow, and a real chance to build financial freedom in the digital world.
    </p>
  </div>
</section>

<!-- Footer -->
<footer class="border-t border-white/10 py-8 text-center text-gray-400">
  © 2025 Mintova — Invest smarter.
</footer>

<script>
  (function () {
    const body = document.body;
    const menuBtn = document.getElementById('menuBtn');
    const overlay = document.getElementById('menuOverlay');
    const mobileMenu = document.getElementById('mobileMenu');
    if (!menuBtn || !overlay || !mobileMenu) return;
    const menuLinks = mobileMenu.querySelectorAll('a, button');
    menuBtn.addEventListener('click', () => body.classList.toggle('menu-open'));
    overlay.addEventListener('click', () => body.classList.remove('menu-open'));
    menuLinks.forEach(el => el.addEventListener('click', () => body.classList.remove('menu-open')));
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') body.classList.remove('menu-open'); });
  })();
</script>

</body>
</html>
