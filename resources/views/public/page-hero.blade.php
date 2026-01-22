@props([
  'title' => '',
  // kalau tidak dikirim, fallback ke images/hero-pages.jpg
  'image' => null,
])

@php
  $bg = $image ?: asset('images/hero-pages.jpg');
@endphp

<section aria-label="Hero"
         class="relative overflow-hidden">
  {{-- background image --}}
  <div class="absolute inset-0 w-full bg-cover bg-center"
       style="background-image:url('{{ $bg }}')"></div>

  {{-- overlay biar teks kebaca --}}
  <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/30 to-black/45"></div>

  {{-- tinggi adaptif --}}
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
              h-[38vh] sm:h-[42vh] md:h-[50vh] lg:h-[56vh]
              flex items-end pb-10 sm:pb-12 md:pb-14">
    <h1 class="text-white text-4xl sm:text-5xl md:text-6xl font-extrabold drop-shadow-lg">
      {{ $title }}
    </h1>
  </div>
</section>
