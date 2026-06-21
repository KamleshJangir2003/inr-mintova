<!-- Header -->
<header class="w-full sticky top-0 z-40 bg-black/40 backdrop-blur-xl border-b border-white/10">
  <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
    
    <!-- Brand -->
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-orange-400 text-black font-extrabold grid place-items-center shadow-[0_0_15px_rgba(132,255,39,0.4)]">

  <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
       xmlns="http://www.w3.org/2000/svg">

    <!-- Outer crypto ring -->
    <circle cx="12" cy="12" r="9"
            stroke="#000000" stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"/>

    <!-- Spark / energy lines -->
    <path d="M12 6V3" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
    <path d="M12 21V18" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
    <path d="M6 12H3" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
    <path d="M21 12H18" stroke="#000000" stroke-width="2" stroke-linecap="round"/>

    <!-- Inner Mintova symbol (N-shaped) -->
    <path d="M8 15V9L16 15V9" 
          stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

  </svg>

</div>

      <div>
        <div class="text-lg font-bold">Mintova</div>
        <div class="text-xs text-gray-400">Smarter Crypto Earnings</div>
      </div>
    </div>

    <!-- Desktop Nav -->
    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">
<a href="index" class="opacity-70 cursor-default">Home</a>
<a href="about" class="opacity-70 cursor-default">About</a>
<a href="mission" class="opacity-70 cursor-default">Mission</a>
    <a href="single_leg_plan" class="opacity-70 cursor-default">Single Leg Plan</a>
<a href="vision" class="opacity-70 cursor-default">Vision</a>
<a href="plan.pdf" class="opacity-70 cursor-default">Business Plan</a>


      <!-- LOGIN (Clickable) -->
      <a href="login" class="bg-orange-400 text-black font-bold px-5 py-2 rounded-full shadow-[0_0_20px_rgba(132,255,39,0.4)] hover:brightness-90 transition">
        Login
      </a>
    </nav>

    <!-- Mobile Menu Button -->
    <button id="menuBtn" class="md:hidden text-3xl">☰</button>
  </div>
</header>


<!-- MOBILE MENU OVERLAY -->
<div id="menuOverlay"></div>

<!-- MOBILE SIDEBAR -->
<nav id="mobileMenu">

  <!-- Logo Section -->
  <div class="flex items-center gap-3 mb-6">
    <div class="w-10 h-10 rounded-xl bg-orange-400 text-black font-extrabold grid place-items-center shadow-[0_0_15px_rgba(132,255,39,0.4)]">

  <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
       xmlns="http://www.w3.org/2000/svg">

    <!-- Outer crypto ring -->
    <circle cx="12" cy="12" r="9"
            stroke="#000000" stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"/>

    <!-- Spark / energy lines -->
    <path d="M12 6V3" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
    <path d="M12 21V18" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
    <path d="M6 12H3" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
    <path d="M21 12H18" stroke="#000000" stroke-width="2" stroke-linecap="round"/>

    <!-- Inner Mintova symbol (N-shaped) -->
    <path d="M8 15V9L16 15V9" 
          stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

  </svg>

</div>

    <div>
      <div class="text-lg font-bold">Mintova</div>
      <div class="text-xs text-gray-400">Crypto Earnings Simplified</div>
    </div>
  </div>

  <div class="h-[1px] w-full bg-white/10 mb-4"></div>

  <!-- Menu Items -->
<div class="flex flex-col text-base font-medium space-y-4">
    <a href="index" class="opacity-70 cursor-pointer hover:opacity-100 transition">Home</a>
    <a href="about" class="opacity-70 cursor-pointer hover:opacity-100 transition">About</a>
    <a href="mission" class="opacity-70 cursor-pointer hover:opacity-100 transition">Mission</a>
  <a href="single_leg_plan" class="opacity-70 cursor-pointer hover:opacity-100 transition">Single Leg Plan</a>
    <a href="vision" class="opacity-70 cursor-pointer hover:opacity-100 transition">Vision</a>
    <a href="plan.pdf" class="opacity-70 cursor-pointer hover:opacity-100 transition">Business Plan</a>
</div>


  <div class="h-[1px] w-full bg-white/10 my-6"></div>

  <!-- LOGIN BUTTON -->
  <a href="login" class="bg-orange-400 text-black font-bold px-4 py-3 rounded-full text-center">
    Login
  </a>

</nav>
