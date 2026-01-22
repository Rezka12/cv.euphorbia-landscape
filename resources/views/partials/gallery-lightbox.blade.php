{{-- resources/views/partials/gallery-lightbox.blade.php --}}
@php use Illuminate\Support\Str; @endphp
@props([
  'id'        => null,
  'urls'      => [],   // array full URLs gambar
  'mainClass' => 'aspect-[16/10] w-full overflow-hidden rounded-2xl shadow',
  'thumbClass'=> 'w-full h-20 object-cover',
])

@php $uid = $id ?: 'glx-'.Str::random(6); @endphp

<div x-data="{ i:0, urls:@js(array_values($urls)) }" class="w-full">
  {{-- viewer utama --}}
  <div class="{{ $mainClass }}">
    <img :src="urls[i]" class="object-cover w-full h-full" alt="">
  </div>

  {{-- thumbnails --}}
  @if(count($urls) > 1)
    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3 mt-3">
      @foreach($urls as $k => $u)
        <button type="button" class="rounded-xl overflow-hidden ring-1 ring-black/5 hover:ring-emerald-400"
                @click="i={{ $k }}">
          <img src="{{ $u }}" class="{{ $thumbClass }}" alt="">
        </button>
      @endforeach
    </div>
  @endif

  {{-- tombol buka lightbox --}}
  <div class="mt-3">
    <button type="button" class="inline-flex items-center px-3 py-2 rounded-lg bg-black/80 text-white"
            @click="$dispatch('open-{{ $uid }}', {i})">
      Lihat Penuh
    </button>
  </div>
</div>

{{-- LIGHTBOX --}}
<div x-data="{ open:false, i:0, urls:@js(array_values($urls)) }"
     x-on:open-{{ $uid }}.window="open=true;i=$event.detail.i ?? 0"
     x-show="open" x-transition.opacity
     class="fixed inset-0 z-[60] bg-black/90 flex items-center justify-center">
  <button class="absolute top-5 right-5 text-white text-2xl" @click="open=false">✕</button>

  <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-3xl" @click="i = (i-1+urls.length)%urls.length">‹</button>

  <img :src="urls[i]" class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-xl" alt="">

  <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-3xl" @click="i = (i+1)%urls.length">›</button>

  <div class="absolute bottom-4 flex gap-2">
    <template x-for="(u,idx) in urls" :key="idx">
      <button class="w-3 h-3 rounded-full"
              :class="idx===i ? 'bg-white' : 'bg-white/40'"
              @click="i=idx"></button>
    </template>
  </div>

  {{-- keyboard nav --}}
  <script>
    document.addEventListener('keydown', (e) => {
      const box = document.querySelector('[x-on\\:open-{{ $uid }}\\.window]');
      if (!box || getComputedStyle(box).display === 'none') return;
      const comp = Alpine.$data(box);
      if (e.key === 'Escape') comp.open = false;
      if (e.key === 'ArrowLeft') comp.i = (comp.i - 1 + comp.urls.length) % comp.urls.length;
      if (e.key === 'ArrowRight') comp.i = (comp.i + 1) % comp.urls.length;
    });
  </script>
</div>
