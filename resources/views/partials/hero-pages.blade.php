@props([
'title' => '',
'subtitle' => null,
'image' => 'images/hero-pages.jpg', // path dari /public
])

<section class="relative isolate">
  {{-- BG hero --}}
  <div class="absolute inset-0 -z-10 pointer-events-none">
    <div
      class="h-64 md:h-80 w-full bg-cover bg-center rounded-b-[2rem] relative"
      @if($image ?? null) style="background-image:url('{{ $image }}')" @endif>
      @if(!empty($overlay))
      <div class="{{ $overlay }} absolute inset-0 rounded-b-[2rem] pointer-events-none"></div>
      @endif
    </div>
  </div>

  {{-- Content judul --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-64 md:h-80 flex items-end">
    <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-md">
      {{ $title }}
    </h1>
  </div>
</section>