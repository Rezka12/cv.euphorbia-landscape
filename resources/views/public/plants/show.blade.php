@extends('layouts.public')

@section('title', $plant->name)

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">

    <div class="mb-6">
        <img src="{{ $plant->image_url }}"
             alt="{{ $plant->name }}"
             class="w-full max-h-[420px] object-cover rounded-2xl">
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-4">
        {{ $plant->name }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <h3 class="font-semibold mb-2">Deskripsi</h3>
            <p class="text-gray-600">{{ $plant->description }}</p>
        </div>

        <div class="bg-white rounded-xl p-4 ring-1 ring-gray-200">
            <h3 class="font-semibold mb-3">Detail Tanaman</h3>
            <p><strong>Kategori:</strong> {{ $plant->category->name ?? '-' }}</p>
        </div>
    </div>

</section>
@endsection
