@extends('layouts.public')

@section('content')
<section class="w-full">
  <img src="{{ asset('images/heroes/projects.jpg') }}" alt="Proyek"
       class="w-full h-[240px] sm:h-[300px] lg:h-[360px] object-cover">
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
  <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 mb-6">Proyek</h1>

  @php
    // Data dari controller:
    $menu = $categories;   // pakai alias biar cocok dengan loop di bawah
    $active = $slug;       // alias biar cocok dengan pengecekan aktif

    $chipBase = 'inline-flex items-center rounded-full px-4 py-2 text-sm border transition';
    $chipOn  = $chipBase.' bg-emerald-700 text-white border-emerald-700 shadow';
    $chipOff = $chipBase.' bg-white text-gray-800 border-gray-200 hover:bg-gray-50';
@endphp

<div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('site.projects') }}" class="{{ $active === 'all' ? $chipOn : $chipOff }}">View All</a>
    @foreach($menu as $slug => $label)
        <a href="{{ route('site.projects', ['category' => $slug]) }}"
           class="{{ ($active === $slug) ? $chipOn : $chipOff }}">
           {{ $label }}
        </a>
    @endforeach
</div>
  </div>

  @if ($projects->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($projects as $p)
        <a href="{{ route('site.projects.show', $p->slug) }}"
           class="block group rounded-2xl overflow-hidden bg-white border border-gray-100 hover:shadow-lg transition">
          <div class="aspect-[16/10] w-full overflow-hidden">
            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
          </div>
          <div class="p-4">
            <div class="text-[11px] font-semibold tracking-widest text-emerald-600 uppercase mb-1">
              {{ $p->status_label }}
            </div>
            <h3 class="text-lg font-semibold text-gray-900">{{ $p->name }}</h3>
            <div class="mt-1 text-xs text-gray-500">{{ $p->category_public_label }}</div>
          </div>
        </a>
      @endforeach
    </div>
    <div class="mt-8">{{ $projects->links() }}</div>
  @else
    <p class="text-gray-500">Belum ada proyek untuk kategori ini.</p>
  @endif
</section>
@endsection
