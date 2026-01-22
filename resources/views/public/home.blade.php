@extends('layouts.public')

@section('title', 'Beranda — Euphorbia LandScape')

@section('content')
<style>
  .img-cover {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .card {
    background: #fff;
    border-radius: .75rem;
    box-shadow: 0 1px 2px rgba(0,0,0,.06), 0 1px 1px -1px rgba(0,0,0,.06);
    transition: transform .25s ease, box-shadow .25s ease;
  }
  .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,.12);
  }
  .chip {
    display: inline-flex;
    align-items: center;
    font-size: .75rem;
    padding: .25rem .6rem;
    border-radius: 9999px;
    background: #e6f9f0;
    color: #1bce2a;
    border: 1px solid #bbefdf;
    font-weight: 600;
  }
</style>

@php
  use Illuminate\Support\Str;
  use Illuminate\Support\Facades\Storage;
@endphp


{{-- ================= HERO ================= --}}
<section class="mb-16">
  <div class="relative h-[42vh] md:h-[52vh] overflow-hidden">
    <img class="absolute inset-0 w-full h-full object-cover"
         src="{{ asset('images/hero-garden.jpg') }}"
         alt="Euphorbia LandScape">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative max-w-7xl mx-auto h-full flex items-center px-6 z-10">
      <div class="text-white max-w-3xl">
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
          Euphorbia LandScape
        </h1>
        <p class="mt-4 text-white/90">
          Landscape Construction · Maintenance · Design & Build · Plant Supplier · Nursery
        </p>
        <div class="mt-6 flex gap-3">
          <a href="{{ route('site.contact') }}"
             class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium">
            Kontak
          </a>
          <a href="{{ route('site.about') }}"
             class="px-5 py-2 rounded-xl bg-white text-emerald-700 font-medium hover:bg-gray-100">
            Tentang Kami
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ================= PROYEK ================= --}}
<section class="max-w-7xl mx-auto px-6 py-16">
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl md:text-3xl font-bold">Proyek On Progress</h2>
    <a href="{{ route('site.projects') }}" class="text-emerald-700 font-medium hover:underline">
      Lihat semua
    </a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ($projects ?? [] as $p)
      @php
        $img = $p->image ? Storage::url($p->image) : asset('images/placeholder-wide.jpg');
      @endphp

      {{-- CARD FULL CLICK --}}
      <a href="{{ route('site.projects.show', $p->slug) }}" class="block">
        <article class="card overflow-hidden h-full">
          <div class="aspect-[16/9] relative">
            <img class="img-cover" src="{{ $img }}" alt="{{ $p->name }}">
          </div>
          <div class="p-4">
            <span class="chip mb-2">ON PROGRESS</span>
            <h3 class="font-semibold text-gray-900">{{ $p->name }}</h3>
          </div>
        </article>
      </a>
    @empty
      <p class="text-gray-500">Belum ada proyek.</p>
    @endforelse
  </div>
</section>

{{-- ================= PORTOFOLIO ================= --}}
<section class="max-w-7xl mx-auto px-6 py-16 bg-gray-50">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl md:text-3xl font-bold">
            Portofolio
        </h2>

        <a 
            href="{{ route('site.portfolio') }}" 
            class="text-emerald-700 font-medium hover:underline"
        >
            Lihat semua
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse (($portfolios ?? collect())->take(3) as $pf)
            @php
                $img = $pf->image
                    ? Storage::url($pf->image)
                    : asset('images/placeholder-wide.jpg');
            @endphp

            <a 
                href="{{ route('site.portfolio.show', $pf->slug) }}" 
                class="block"
            >
                <article class="card overflow-hidden h-full">
                    <div class="aspect-[16/9] relative">
                        <img 
                            src="{{ $img }}" 
                            alt="{{ $pf->name }}"
                            class="img-cover"
                        >
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900">
                            {{ $pf->name }}
                        </h3>
                    </div>
                </article>
            </a>
        @empty
            <p class="text-gray-500">
                Belum ada portofolio.
            </p>
        @endforelse
    </div>
</section>


{{-- ================= TANAMAN ================= --}}
<section class="max-w-7xl mx-auto px-6 py-16">
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl md:text-3xl font-bold">Katalog Tanaman</h2>
    <a href="{{ route('site.plants') }}"
       class="text-emerald-700 font-medium hover:underline">
      Lihat katalog
    </a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @forelse (($plants ?? collect())->take(4) as $pl)
      @php
        $img = $pl->image
          ? Storage::url($pl->image)
          : asset('images/placeholder-square.jpg');
      @endphp

      @if(!empty($pl->slug))
        <a href="{{ route('site.plants.show', ['slug' => $pl->slug]) }}" class="block">
      @else
        <div class="block cursor-not-allowed opacity-70">
      @endif

        <article class="card overflow-hidden h-full text-center">
          <div class="aspect-square relative">
            <img class="img-cover" src="{{ $img }}" alt="{{ $pl->name }}">
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900">{{ $pl->name }}</h3>
          </div>
        </article>

      @if(!empty($pl->slug))
        </a>
      @else
        </div>
      @endif

    @empty
      <p class="text-gray-500">Belum ada tanaman.</p>
    @endforelse
  </div>
</section>
@endsection