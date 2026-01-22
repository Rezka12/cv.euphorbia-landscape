{{-- resources/views/public/partials/hero.blade.php --}}
@props([
  'title' => 'Judul Halaman',
  'subtitle' => null,
  'image' => 'images/hero-pages.jpg',
])

<section aria-label="Hero" class="relative overflow-hidden">
  {{-- background image --}}
  <div class="absolute inset-0 bg-cover bg-center"
       style="background-image:url('{{ asset($image) }}')"></div>

  {{-- overlay gradasi agar teks kebaca --}}
  <div class="absolute inset-0 bg-gradient-to-b from-black/35 to-black/60"></div>

  {{-- konten --}}
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
              h-[42vh] sm:h-[48vh] md:h-[56vh] flex items-end py-10 md:py-12">
    <div>
      <h1 class="text-white text-5xl sm:text-6xl font-extrabold drop-shadow-[0_6px_12px_rgba(0,0,0,.45)]">
        {{ $title }}
      </h1>

      @if($subtitle)
        <p class="mt-4 text-white/90 text-base sm:text-lg max-w-3xl">
          {{ $subtitle }}
        </p>
      @endif
    </div>
  </div>
</section>
