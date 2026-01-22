@extends('layouts.public')

@section('content')
<section class="w-full">
  <img src="{{ asset('images/heroes/projects.jpg') }}" alt="Portofolio"
       class="w-full h-[240px] sm:h-[300px] lg:h-[360px] object-cover">
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
  <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 mb-6">Portofolio</h1>

  @php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    // fallback aman
    $menu   = $menu ?? [];
    $active = $active ?? 'all';

    // style chip
    $chipBase = 'inline-flex items-center rounded-full px-4 py-2 text-sm border transition';
    $chipOn  = $chipBase.' bg-emerald-700 text-white border-emerald-700 shadow';
    $chipOff = $chipBase.' bg-white text-gray-800 border-gray-200 hover:bg-gray-50';
  @endphp

  <div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('site.portfolio') }}" class="{{ $active === 'all' ? $chipOn : $chipOff }}">View All</a>
    @foreach($menu as $slug => $meta)
      <a href="{{ route('site.portfolio', ['category' => $slug]) }}"
         class="{{ ($active === $slug) ? $chipOn : $chipOff }}">
         {{ $meta['label'] }}
      </a>
    @endforeach
  </div>

  @if ($portfolios->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($portfolios as $p)
        @php
          $img = $p->image
              ? (Str::startsWith($p->image, ['http://', 'https://', '/storage/'])
                  ? $p->image
                  : Storage::url($p->image))
              : asset('images/placeholder.jpg');

          $slug = $p->slug ?: $p->id;
          $firstCat = $p->categories->first();
        @endphp

        <a href="{{ route('site.portfolio.show', ['slug' => $slug]) }}"
           class="block group rounded-2xl overflow-hidden bg-white border border-gray-100 hover:shadow-lg transition">
          <div class="aspect-[16/10] w-full overflow-hidden">
            <img src="{{ $img }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
          </div>
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900">{{ $p->name }}</h3>
            @if($firstCat)
              <div class="mt-1 text-xs text-gray-500">{{ $firstCat->name }}</div>
            @endif
          </div>
        </a>
      @endforeach
    </div>
    <div class="mt-8">{{ $portfolios->links() }}</div>
  @else
    <p class="text-gray-500">Belum ada portofolio untuk kategori ini.</p>
  @endif
</section>
@endsection