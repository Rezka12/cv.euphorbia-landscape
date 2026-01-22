{{-- resources/views/partials/gallery-masonry.blade.php --}}
@props([
  // bisa array of string URL, atau collection ProjectPhoto (punya properti "path")
  'photos' => [],
  // fallback cover (mis. gambar utama proyek) kalau photos kosong
  'cover'  => null,
  // jumlah kolom masonry default
  'colsSm' => 1, 'colsMd' => 2, 'colsLg' => 3,
])

@php
use Illuminate\Support\Str;

$raw = collect($photos)->map(function ($p) {
    // dukung: string URL langsung, array ['path'=>..], object ->path/->url
    $path = is_string($p) ? $p
          : (is_array($p) ? ($p['path'] ?? $p['url'] ?? null)
          : (is_object($p) ? ($p->path ?? $p->url ?? null) : null));

    if (!$path) return null;

    // normalisasi ke url publik
    if (Str::startsWith($path, ['http://', 'https://', '/storage'])) {
        return $path;
    }
    return asset('storage/'.$path);
})->filter()->values();

// fallback pakai cover kalau tak ada foto tambahan
if ($raw->isEmpty() && $cover) {
    $raw = collect([$cover]);
}
$urls = $raw->values(); // final
@endphp

@if($urls->isEmpty())
  <p class="text-gray-600">Belum ada foto untuk proyek ini.</p>
@else
  <div
    x-data="{ open:false, i:0, urls:@js($urls) }"
    class="w-full"
  >
    {{-- MASONRY --}}
    <div class="gap-4
                columns-{{ $colsSm }}
                sm:columns-{{ $colsMd }}
                lg:columns-{{ $colsLg }}">
      @foreach($urls as $k => $u)
        <a href="#" @click.prevent="open=true; i={{ $k }}"
           class="break-inside-avoid mb-4 block rounded-xl overflow-hidden ring-1 ring-black/5 hover:ring-emerald-400">
          <img src="{{ $u }}" alt="" class="w-full h-auto object-cover" loading="lazy">
        </a>
      @endforeach
    </div>

    {{-- LIGHTBOX --}}
    <template x-if="open">
      <div class="fixed inset-0 z-[60] bg-black/90 flex items-center justify-center">
        <button class="absolute top-5 right-5 text-white text-3xl" @click="open=false">✕</button>

        <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl"
                @click="i=(i-1+urls.length)%urls.length">‹</button>

        <img :src="urls[i]" class="max-w-[92vw] max-h-[92vh] object-contain rounded-lg shadow-xl" alt="">

        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl"
                @click="i=(i+1)%urls.length">›</button>

        <div class="absolute bottom-5 flex gap-2">
          <template x-for="(u,idx) in urls" :key="idx">
            <button class="w-2.5 h-2.5 rounded-full"
                    :class="idx===i ? 'bg-white' : 'bg-white/40'"
                    @click="i=idx"></button>
          </template>
        </div>
      </div>
    </template>
  </div>
@endif
