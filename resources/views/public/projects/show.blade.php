@extends('layouts.public')
@section('title', $project->name)

@php
use Illuminate\Support\Str;
$hero = $project->image
  ? (Str::startsWith($project->image,['http://','https://','/storage']) ? $project->image : asset('storage/'.$project->image))
  : asset('images/hero-pages.jpg');
@endphp

@section('content')

{{-- Hero --}}
<section class="relative isolate">
  <div class="absolute inset-0 -z-10">
    <div class="h-64 md:h-80 w-full bg-cover bg-center rounded-b-[2rem]"
         style="background-image:url('{{ $hero }}')">
      <div class="bg-gradient-to-b from-black/20 to-black/50 absolute inset-0 rounded-b-[2rem]"></div>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-64 md:h-80 flex items-end">
    <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-md">
      {{ $project->name }}
    </h1>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <div class="grid md:grid-cols-3 gap-8">
    {{-- Kiri: status + deskripsi + detail --}}
    <div class="md:col-span-1 space-y-6">
      <div class="rounded-2xl border border-black/5 bg-white/80 backdrop-blur p-5 shadow-sm">
        <div class="text-xs uppercase tracking-wide text-emerald-700 font-semibold">
          {{ $project->status === 'completed' ? 'Selesai' : 'In Progress' }}
        </div>
      </div>

      <div class="rounded-2xl border border-black/5 bg-white/80 backdrop-blur p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-2">Deskripsi</h2>
        <p class="text-black/80">{{ $project->description ?: '—' }}</p>
      </div>

      <div class="rounded-2xl border border-black/5 bg-white/80 backdrop-blur p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-3">Detail Proyek</h2>
        <dl class="space-y-2 text-black/80">
          <div><dt class="font-medium">Klien</dt><dd>{{ $project->client ?: '—' }}</dd></div>
          <div><dt class="font-medium">Lokasi</dt><dd>{{ $project->location ?: '—' }}</dd></div>
        </dl>
      </div>
    </div>

    {{-- Kanan: Galeri foto 3 kolom responsif --}}
    <div class="md:col-span-2">
      @php $photos = $project->photos; @endphp

      @if($photos->count() === 0)
        @if($project->image)
          <img src="{{ $hero }}" class="w-full rounded-2xl shadow object-cover aspect-[4/3]" alt="">
        @else
          <p class="text-black/60">Belum ada foto untuk proyek ini.</p>
        @endif
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($photos as $p)
            <img src="{{ $p->url }}"
                 class="w-full aspect-[4/3] object-cover rounded-2xl shadow"
                 alt="Foto Proyek">
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
@endsection
