@props([
    'title'   => 'Judul Halaman',
    // Berikan URL penuh (mis. asset('images/hero-portfolio.jpg'))
    'bg'      => null,
    // Tailwind classes untuk overlay gradient (boleh kosong untuk tanpa overlay)
    'overlay' => 'bg-gradient-to-b from-emerald-900/50 to-emerald-950/70',
])

<section class="relative isolate">
    {{-- Background image --}}
    <div class="absolute inset-0 -z-10">
        <div
            class="h-64 md:h-80 w-full bg-cover bg-center rounded-b-[2rem] relative"
            @if($bg) style="background-image: url('{{ $bg }}');" @endif
        >
            @if($overlay)
                {{-- Overlay gradient di atas foto --}}
                <div class="{{ $overlay }} absolute inset-0 rounded-b-[2rem]"></div>
            @endif
        </div>
    </div>

    {{-- Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-64 md:h-80 flex items-end">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-md">
            {{ $title }}
        </h1>
    </div>
</section>
