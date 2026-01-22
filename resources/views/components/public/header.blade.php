@php
  $isActive = fn($name) => request()->routeIs($name) ? 'text-emerald-300' : 'text-stone-200';
@endphp

<header x-data="{open:false, dd:{tanaman:false, arsitek:false, aplikasi:false, lainnya:false, tentang:false}}"
        class="sticky top-0 z-50 backdrop-blur bg-stone-900/90 border-b border-stone-800">
  <nav class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
    {{-- Brand --}}
    <a href="{{ route('site.home') }}" class="flex items-center gap-3">
      <span class="inline-flex h-9 w-9 rounded-md bg-emerald-600 items-center justify-center">
        {{-- logo daun sederhana --}}
        <svg viewBox="0 0 24 24" class="h-5 w-5 text-white" fill="currentColor"><path d="M12 3c4.97 0 9 4.03 9 9 0 4.24-2.94 7.8-6.9 8.74a1 1 0 0 1-1.22-.97V16a6 6 0 0 0-6-6H4a1 1 0 0 1-.97-1.22C4.97 5.94 8.53 3 12 3z"/></svg>
      </span>
      <div class="leading-tight">
        <p class="text-stone-50 font-semibold">Kontraktor Taman</p>
        <p class="text-stone-400 text-xs">Landscape & Nursery</p>
      </div>
    </a>

    {{-- Desktop menu --}}
    <ul class="hidden md:flex items-center gap-6">
      <li><a href="{{ route('site.home') }}" class="hover:text-emerald-300 {{ $isActive('site.home') }}">Home</a></li>

      {{-- Tanaman (dropdown) --}}
      <li class="relative" x-data="{open:false}" @mouseenter="open=true" @mouseleave="open=false">
        <button class="inline-flex items-center gap-1 hover:text-emerald-300 {{ request()->routeIs('site.plants*') ? 'text-emerald-300' : 'text-stone-200' }}">
          Tanaman
          <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z"/></svg>
        </button>
        <div x-show="open" x-transition
             class="absolute left-0 mt-3 w-56 rounded-xl border border-stone-800 bg-stone-900/95 shadow-lg p-2">
          <a href="{{ route('site.plants') }}" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Katalog Tanaman</a>
          <a href="{{ route('site.categories') }}" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Kategori</a>
        </div>
      </li>

      {{-- Arsitek --}}
      <li class="relative" x-data="{open:false}" @mouseenter="open=true" @mouseleave="open=false">
        <button class="inline-flex items-center gap-1 hover:text-emerald-300 text-stone-200">
          Arsitek <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z"/></svg>
        </button>
        <div x-show="open" x-transition
             class="absolute left-0 mt-3 w-64 rounded-xl border border-stone-800 bg-stone-900/95 shadow-lg p-2">
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Desain Taman</a>
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Konsultasi</a>
        </div>
      </li>

      {{-- Aplikasi --}}
      <li class="relative" x-data="{open:false}" @mouseenter="open=true" @mouseleave="open=false">
        <button class="inline-flex items-center gap-1 hover:text-emerald-300 text-stone-200">
          Aplikasi <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z"/></svg>
        </button>
        <div x-show="open" x-transition
             class="absolute left-0 mt-3 w-64 rounded-xl border border-stone-800 bg-stone-900/95 shadow-lg p-2">
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Rooftop / Indoor</a>
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Landscape Komersial</a>
        </div>
      </li>

      <li><a href="{{ route('site.services') }}" class="hover:text-emerald-300 {{ request()->routeIs('site.services') ? 'text-emerald-300' : 'text-stone-200' }}">Layanan</a></li>

      <li class="relative" x-data="{open:false}" @mouseenter="open=true" @mouseleave="open=false">
        <button class="inline-flex items-center gap-1 hover:text-emerald-300 text-stone-200">
          Lainnya <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z"/></svg>
        </button>
        <div x-show="open" x-transition class="absolute left-0 mt-3 w-56 rounded-xl border border-stone-800 bg-stone-900/95 shadow-lg p-2">
          <a href="{{ route('site.projects') }}" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Proyek</a>
          <a href="{{ route('site.portfolio') }}" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Portofolio</a>
        </div>
      </li>

      <li class="relative" x-data="{open:false}" @mouseenter="open=true" @mouseleave="open=false">
        <button class="inline-flex items-center gap-1 hover:text-emerald-300 {{ request()->routeIs('site.about') ? 'text-emerald-300' : 'text-stone-200' }}">
          Tentang <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z"/></svg>
        </button>
        <div x-show="open" x-transition class="absolute left-0 mt-3 w-56 rounded-xl border border-stone-800 bg-stone-900/95 shadow-lg p-2">
          <a href="{{ route('site.about') }}" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Profil</a>
          <a href="{{ route('site.contact') }}" class="block px-3 py-2 rounded-lg hover:bg-stone-800">Kontak</a>
        </div>
      </li>

      <li>
        <a href="{{ route('site.contact') }}"
           class="inline-flex h-9 items-center rounded-lg bg-emerald-600 px-4 text-white hover:bg-emerald-500">
           Kontak
        </a>
      </li>
    </ul>

    {{-- Mobile burger --}}
    <button class="md:hidden text-stone-200" @click="open = !open" aria-label="Toggle menu">
      <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path x-show="!open" d="M4 6h16M4 12h16M4 18h16"/><path x-show="open" d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
  </nav>

  {{-- Mobile panel --}}
  <div class="md:hidden" x-show="open" x-transition>
    <div class="px-4 pb-4 space-y-2 bg-stone-900/95 border-t border-stone-800">
      <a class="block py-2 {{ $isActive('site.home') }}" href="{{ route('site.home') }}">Home</a>
      <a class="block py-2" href="{{ route('site.plants') }}">Tanaman</a>
      <a class="block py-2" href="{{ route('site.services') }}">Layanan</a>
      <a class="block py-2" href="{{ route('site.projects') }}">Proyek</a>
      <a class="block py-2" hr
