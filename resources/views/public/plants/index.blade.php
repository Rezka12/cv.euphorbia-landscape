@extends('layouts.public')

@section('title', 'Tanaman')

@section('content')
    {{-- HERO --}}
    @include('partials.hero-pages', [
        'title'   => 'Tanaman Hias',
        'image'   => asset('images/hero-pages.jpg'),
        'overlay' => 'bg-gradient-to-b from-emerald-900/40 to-emerald-950/60'
    ])

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- FILTER CHIP --}}
        <div class="relative z-20 flex flex-wrap gap-2 sm:gap-3 my-6">
            {{-- ALL --}}
            <a href="{{ route('site.plants') }}"
               class="filter-chip {{ request()->filled('kategori') ? '' : 'active' }}">
                View All
            </a>

            {{-- PER KATEGORI (pakai ID biar pasti ada) --}}
            @foreach($categories as $cat)
                <a href="{{ route('site.plants', ['kategori' => $cat->id]) }}"
                   class="filter-chip {{ optional($activeCategory)->id === $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- GRID LIST TANAMAN --}}
        @if($plants->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($plants as $plant)
                    <div class="bg-white rounded-xl shadow border overflow-hidden">
                        <img
                            src="{{ $plant->image ? asset('storage/'.$plant->image) : asset('images/placeholder.jpg') }}"
                            alt="{{ $plant->name }}"
                            class="w-full h-56 object-cover"
                        >

                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $plant->name }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $plant->category?->name ?? '-' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $plants->links() }}
            </div>
        @else
            <p class="text-gray-500">Belum ada data tanaman.</p>
        @endif
    </div>

    {{-- STYLE CHIP (kalau belum ada) --}}
    <style>
        .filter-chip{
            display:inline-flex;align-items:center;gap:.5rem;
            padding:.5rem 1rem;border-radius:9999px;border:1px solid #d1d5db;
            color:#111827;background:#fff;line-height:1;transition:.15s ease-in-out;
        }
        .filter-chip:hover{box-shadow:0 4px 14px rgba(0,0,0,.08)}
        .filter-chip.active{
            background:#047857;color:#fff;border-color:#047857;
            box-shadow:0 6px 18px rgba(4,120,87,.25)
        }
    </style>
@endsection
