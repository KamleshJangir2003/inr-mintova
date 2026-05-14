<?php
include('admin/inc/function.php');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vision - Mintova</title>
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

<!-- Vision Section -->
<section id="vision" class="mn-section max-w-6xl mx-auto px-6 py-16">
  <span class="px-5 py-1 bg-orange-400/20 text-orange-300 text-xs font-bold rounded-full tracking-wide">
    OUR VISION
  </span>

  <h2 class="text-3xl md:text-4xl font-extrabold mt-5 mb-4">
    Building the World's Most Trusted Digital Income Ecosystem
  </h2>

  <p class="text-gray-300 text-lg leading-relaxed max-w-3xl">
    Our vision is to create a next-generation global earning platform where millions of users
    can earn stable income through technology-driven, decentralized and transparent systems.
  </p>

  <div class="grid md:grid-cols-2 gap-6 mt-10">
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">1. A Global Earning Network</h4>
      <p class="text-gray-300 text-sm">Mintova aims to become a universal earning ecosystem that connects people from all countries with equal opportunities to grow financially.</p>
    </div>
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">2. Secure & Transparent System</h4>
      <p class="text-gray-300 text-sm">Our vision includes complete clarity in how rewards are generated — with transparent calculations, real-time dashboards, and user-controlled performance metrics.</p>
    </div>
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">3. Sustainable Income Models</h4>
      <p class="text-gray-300 text-sm">We are building stable earning infrastructures that focus on long-term survival, system evolution, and balanced reward distribution.</p>
    </div>
    <div class="p-6 bg-white/5 border border-white/10 rounded-xl">
      <h4 class="font-bold mb-2 text-orange-300">4. Technology-Driven Future</h4>
      <p class="text-gray-300 text-sm">Through automation, fast transactions, blockchain alignment, and global scaling methods — Mintova will evolve into a future-proof digital income platform.</p>
    </div>
  </div>

  <div class="mt-10 p-6 bg-white/5 border border-white/10 rounded-xl">
    <h3 class="text-xl font-bold mb-3">A Future Ready For Everyone</h3>
    <p class="text-gray-300 text-sm leading-relaxed">
      Our long-term vision is to give every individual — regardless of background —
      a simple, safe and digital-first method to grow their income.
      Mintova will continue innovating to bring the best earning technologies to everyday users across the world.
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
