@props([
  'title' => 'Tanaman Hias',
  'subtitle' => null,
])

<section class="relative overflow-hidden rounded-b-[48px] bg-gradient-to-r from-emerald-900 to-emerald-700">
  {{-- daun dekoratif (SVG bebas) --}}
  <svg class="absolute inset-0 w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
    <defs>
      <linearGradient id="g" x1="0" x2="1" y1="0" y2="1">
        <stop stop-color="#ffffff" stop-opacity="0.15" offset="0"/>
        <stop stop-color="#ffffff" stop-opacity="0.0" offset="1"/>
      </linearGradient>
    </defs>
    <g fill="url(#g)">
      <path d="M0,180 C200,120 260,40 520,60 C820,82 980,10 1200,0 L1200,0 L1200,320 L0,320 Z"></path>
      <circle cx="15%" cy="25%" r="160"></circle>
      <circle cx="85%" cy="70%" r="220"></circle>
    </g>
  </svg>

  <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight">
      {{ $title }}
    </h1>
    @if($subtitle)
      <p class="mt-4 text-emerald-100 text-lg max-w-3xl">{{ $subtitle }}</p>
    @endif
  </div>
</section>
