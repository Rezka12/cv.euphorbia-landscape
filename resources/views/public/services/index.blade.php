@extends('layouts.public')
@section('title', 'Layanan')

@section('content')
@include('partials.hero-pages', [
'title' => 'Layanan',
'image' => 'images/hero-pages.jpg',
])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <div class="grid md:grid-cols-2 gap-8">
    @forelse ($services as $service)
      <a class="group block">
        <div class="aspect-[16/9] overflow-hidden rounded-2xl bg-stone-100">
          <img
            src="{{ $service->image ? asset('storage/'.$service->image) : asset('images/placeholder-service.jpg') }}"
            alt="{{ $service->name }}"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        </div>
        <div class="mt-3">
          <h3 class="text-xl font-semibold text-stone-900">{{ $service->name }}</h3>
          <p class="mt-1 text-stone-600">
            {{ \Illuminate\Support\Str::limit($service->description, 100) }}
          </p>
        </div>
      </a>
    @empty
      <p class="text-stone-500">Belum ada layanan.</p>
    @endforelse
  </div>
</div>
@endsection
