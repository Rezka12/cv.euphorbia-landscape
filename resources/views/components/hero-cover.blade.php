@props(['title' => '', 'image' => null])

@php
    use Illuminate\Support\Str;

    $img = $image
        ? (Str::startsWith($image, ['http://','https://'])
            ? $image
            : asset('storage/'.$image))
        : asset('images/placeholder.jpg'); // fallback kalau belum ada gambar
@endphp

<section class="relative">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div
      class="h-[220px] sm:h-[300px] lg:h-[360px] rounded-2xl overflow-hidden border border-gray-200/50"
      style="
        background-image:
          linear-gradient(180deg, rgba(0,0,0,.15), rgba(0,0,0,.15)),
          url('{{ $img }}');
        background-position:center;
        background-size:cover;
        background-repeat:no-repeat;
      ">
    </div>

    @if($title)
      <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900">
        {{ $title }}
      </h1>
    @endif
  </div>
</section>
