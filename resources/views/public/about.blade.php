@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
    {{-- ========== HERO ========== --}}
    <section class="relative h-[42vh] min-h-[320px] w-full overflow-hidden rounded-b-3xl">
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image:url('{{ $cover }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/30 to-black/60"></div>
        <div class="container relative z-10 mx-auto flex h-full items-end px-4 pb-10">
            <h1 class="text-4xl font-extrabold text-white drop-shadow md:text-6xl">
                Tentang Kami
            </h1>
        </div>
    </section>

    {{-- ========== BODY ========== --}}
    <section class="container mx-auto grid gap-10 px-4 py-12 md:grid-cols-12">
        {{-- KONTEN UTAMA --}}
        <article class="md:col-span-8">
            {{-- Tipografi cantik untuk HTML dari DB --}}
            <div class="prose prose-zinc max-w-none prose-a:text-emerald-700 hover:prose-a:text-emerald-900
                        prose-headings:font-bold prose-h2:mt-8 prose-h2:text-2xl
                        prose-strong:font-extrabold prose-li:marker:text-emerald-600">
                {!! $about?->description ?? '<p>Konten tentang perusahaan belum tersedia.</p>' !!}
            </div>
        </article>

        {{-- SIDEBAR --}}
        <aside class="md:col-span-4">
            <div class="sticky top-24 space-y-6">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $cover }}" alt="Foto perusahaan" class="h-56 w-full object-cover">
                </div>

                <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-2 text-lg font-semibold">Profil Singkat</h3>
                    <p class="text-sm text-zinc-600">
                        CV. Euphorbia Landscape adalah kontraktor & nursery yang berfokus pada kualitas tanaman,
                        ketepatan waktu, dan hasil rapi.
                    </p>
                </div>
            </div>
        </aside>
    </section>

    {{-- ========== HIGHLIGHTS / RUANG LINGKUP ========== --}}
    <section class="bg-emerald-50/60 py-12">
        <div class="container mx-auto px-4">
            <h3 class="mb-6 text-2xl font-bold">Ruang Lingkup Pekerjaan</h3>

            <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($highlights as $item)
                    <li class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm">
                        <p class="font-semibold">{{ $item['title'] }}</p>
                        <p class="mt-1 text-sm text-zinc-600">{{ $item['desc'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
