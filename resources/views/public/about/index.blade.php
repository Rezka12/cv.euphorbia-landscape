@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')

{{-- HERO --}}
<section class="relative h-[300px]">
    @if(!empty($about?->image))
        <img src="{{ asset('storage/'.$about->image) }}"
             class="w-full h-full object-cover">
    @else
        <div class="w-full h-full bg-gray-400"></div>
    @endif

    <div class="absolute inset-0 flex items-center px-8">
        <h1 class="text-4xl font-bold text-white">Tentang Kami</h1>
    </div>
</section>

{{-- CONTENT --}}
<section class="max-w-6xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8">
    <div class="md:col-span-2
            prose
            prose-xl
            leading-relaxed
            max-w-none
            prose-p:mb-5">
    {!! $about->description !!}
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold mb-2">Profil Singkat</h3>
        <p class="text-sm text-gray-600">
            CV. Euphorbia Landscape berfokus pada kualitas tanaman,
            ketepatan waktu, dan hasil kerja rapi.
        </p>
    </div>
</section>

@endsection
