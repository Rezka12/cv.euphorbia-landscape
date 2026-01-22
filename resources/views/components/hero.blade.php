@props([
    'title'    => 'Judul Halaman',
    // Berikan URL penuh, contoh: asset('images/hero-pages.jpg')
    'bg'       => null,
    // Tailwind classes untuk overlay gradient (kosongkan jika tidak perlu)
    'overlay'  => 'bg-gradient-to-b from-emerald-900/50 to-emerald-950/70',
    // Tinggi responsif supaya konsisten di semua halaman
    'height'   => 'h-64 md:h-80',
    // Radius bawah agar seragam dengan style home
    'rounded'  => 'rounded-b-[2rem]',
])

<section {{ $attributes->merge(['class' => 'relative isolate']) }}>
    {{-- Background image --}}
    <div class="absolute inset-0 -z-10">
        <div
            class="{{ $height }} w-full bg-cover bg-center {{ $rounded }} relative"
            @if($bg) style="background-image: url('{{ $bg }}');" @endif
        >
            @if($overlay)
                <div class="{{ $overlay }} absolute inset-0 {{ $rounded }}"></div>
            @endif
        </div>
    </div>

    {{-- Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 {{ $height }} flex items-end">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-md">
            {{ $title }}
        </h1>
    </div>
</section>
