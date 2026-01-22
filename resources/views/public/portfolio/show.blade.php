@extends('layouts.public')

@section('title', $portfolio->name)

@section('content')
@php
  // URL hero dari image utama (fallback ke placeholder)
  $hero = $portfolio->image
    ? Storage::url($portfolio->image)
    : asset('images/placeholder.jpg');
@endphp

{{-- Hero --}}
<section class="w-full">
  <div
    class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-6 mb-4">
    <div class="h-[280px] sm:h-[300px] lg:h-[360px] rounded-2xl overflow-hidden border border-gray-200"
         style="background:
                linear-gradient(180deg, rgba(255,255,255,.0), rgba(0,0,0,.10)),
                url('{{ $hero }}') center / cover no-repeat;">
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
  {{-- Judul --}}
  <div class="mt-6">
    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900">
      {{ $portfolio->name }}
    </h1>
  </div>

  {{-- Deskripsi + detail --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
    <div class="rounded-2xl bg-white shadow-sm p-6">
      <h2 class="font-semibold text-lg mb-3">Deskripsi</h2>
      <p class="text-gray-700 whitespace-pre-line">{{ $portfolio->description ?: '-' }}</p>
    </div>

    <div class="rounded-2xl bg-white shadow-sm p-6">
      <h2 class="font-semibold text-lg mb-3">Detail Proyek</h2>
      <dl class="text-gray-700 space-y-2">
        <div>
          <dt class="font-medium">Klien</dt>
          <dd>{{ $portfolio->client ?: '-' }}</dd>
        </div>
        <div>
          <dt class="font-medium">Lokasi</dt>
          <dd>{{ $portfolio->location ?: '-' }}</dd>
        </div>
        @if ($portfolio->categories->count())
          <div class="pt-2">
            <dt class="font-medium mb-2">Kategori</dt>
            <dd class="flex flex-wrap gap-2">
              @foreach ($portfolio->categories as $c)
                <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 text-xs px-3 py-1">
                  {{ $c->name }}
                </span>
              @endforeach
            </dd>
          </div>
        @endif
      </dl>
    </div>
  </div>

  {{-- Galeri: SERAGAM --}}
  @if ($portfolio->photos->count())
    <div class="mt-10">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($portfolio->photos as $photo)
          <figure class="rounded-2xl overflow-hidden bg-white shadow-sm">
            <div class="aspect-[4/3] w-full">
              <img
                src="{{ Storage::url($photo->path) }}"
                alt="{{ $portfolio->name }} photo"
                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                loading="lazy">
            </div>
          </figure>
        @endforeach
      </div>
    </div>
  @endif
</section>
@endsection
