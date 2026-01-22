<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Euphorbia LandScape')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-stone-50 text-stone-800 antialiased">
  {{-- ================= HEADER ================= --}}
  <header class="sticky top-0 z-50 bg-gradient-to-r from-emerald-600 to-green-600 shadow text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-14 items-center justify-between">
        {{-- Brand --}}
        <a href="{{ route('site.home') }}" class="inline-flex items-center gap-2">
          <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-300"></span>
          <span class="font-semibold tracking-wide">CV Euphorbia LandScape</span>
        </a>

        {{-- Desktop nav --}}
        <nav class="hidden md:flex items-center gap-6">
          <a href="{{ route('site.home') }}" class="hover:underline {{ request()->routeIs('site.home') ? 'underline' : '' }}">Beranda</a>

         {{-- PROYEK DROPDOWN --}}
        <div class="relative group">
          <button class="inline-flex items-center hover:underline">Proyek ▾</button>
          <div class="absolute left-0 top-full w-56 z-50 hidden group-hover:block">
            <ul class="bg-emerald-600 text-white rounded shadow-md">
              <li><a href="{{ route('site.projects') }}" class="block px-4 py-2 hover:bg-emerald-700">Semua Proyek</a></li>
              <li><a href="{{ route('site.projects', ['category' => 'design-build']) }}" class="block px-4 py-2 hover:bg-emerald-700">Landscape Construction</a></li>
              <li><a href="{{ route('site.projects', ['category' => 'maintenance']) }}" class="block px-4 py-2 hover:bg-emerald-700">Landscape Maintenance</a></li>
            </ul>
          </div>
        </div>

          {{-- PORTOFOLIO DROPDOWN --}}
          <div class="relative group">
            <button class="inline-flex items-center hover:underline">Portofolio ▾</button>
            <div class="absolute left-0 top-full w-56 z-50 hidden group-hover:block">
              <ul class="bg-emerald-600 text-white rounded shadow-md">
                <li><a href="{{ route('site.portfolio') }}" class="block px-4 py-2 hover:bg-emerald-700">Semua Portofolio</a></li>
                <li><a href="{{ route('site.portfolio', ['category' => 'design-build']) }}" class="block px-4 py-2 hover:bg-emerald-700">Landscape Construction</a></li>
                <li><a href="{{ route('site.portfolio', ['category' => 'maintenance']) }}" class="block px-4 py-2 hover:bg-emerald-700">Landscape Maintenance</a></li>
              </ul>
            </div>
          </div>



          <a href="{{ route('site.plants') }}" class="hover:underline">Tanaman</a>
          <a href="{{ route('site.about') }}" class="hover:underline">Tentang</a>
          <a href="{{ route('site.contact') }}" class="bg-white text-emerald-700 px-3 py-1 rounded hover:bg-gray-100">Kontak</a>
        </nav>

        {{-- Mobile button --}}
        <button id="navToggle" class="md:hidden" aria-label="Menu">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    {{-- Mobile nav --}}
    <nav id="mobileNav" class="md:hidden hidden border-t border-white/10">
      <div class="px-4 py-3 space-y-1">
        <a class="block py-2 hover:underline" href="{{ route('site.home') }}">Beranda</a>

        <div class="pt-2">
          <div class="text-xs uppercase opacity-70 mb-1">Proyek</div>
          <a class="block py-2 hover:text-white" href="{{ route('site.projects') }}">Semua Proyek</a>
          <a class="block py-2 hover:text-white" href="{{ route('site.projects', ['category' => 'design-build']) }}">Landscape Construction</a>
          <a class="block py-2 hover:text-white" href="{{ route('site.projects', ['category' => 'maintenance']) }}">Landscape Maintenance</a>
        </div>

        <div class="pt-4">
          <div class="text-xs uppercase opacity-70 mb-1">Portofolio</div>
          <a class="block py-2 hover:text-white" href="{{ route('site.portfolio') }}">Semua Portofolio</a>
          <a class="block py-2 hover:text-white" href="{{ route('site.portfolio', ['category' => 'design-build']) }}">Landscape Construction</a>
          <a class="block py-2 hover:text-white" href="{{ route('site.portfolio', ['category' => 'maintenance']) }}">Landscape Maintenance</a>
        </div>

        <div class="pt-4">
          <a class="block py-2 hover:text-white" href="{{ route('site.plants') }}">Tanaman</a>
          <a class="block py-2 hover:text-white" href="{{ route('site.about') }}">Tentang</a>
          <a class="block py-2 hover:text-white" href="{{ route('site.contact') }}">Kontak</a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  {{-- FOOTER --}}
  @include('partials.public-footer')

  <script>
    (() => {
      if (window.EL_NAV_READY) return;
      window.EL_NAV_READY = true;
      const btn = document.getElementById('navToggle');
      const nav = document.getElementById('mobileNav');
      if (btn && nav) btn.addEventListener('click', () => nav.classList.toggle('hidden'));
    })();
  </script>
</body>
</html>