@extends('layouts.admin')

@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<h4 class="mb-3">Edit Portofolio</h4>

<form method="POST"
    action="{{ route('admin.portfolios.update', $portfolio) }}"
    enctype="multipart/form-data"
    class="mb-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control"
            value="{{ old('name', $portfolio->name) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $portfolio->description) }}</textarea>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Klien</label>
            <input type="text" name="client" class="form-control" value="{{ old('client', $portfolio->client) }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $portfolio->location) }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Kategori</label>
        @foreach($categories as $cat)
        @php
        $checked = isset($portfolio)
        ? $portfolio->categories->pluck('id')->contains($cat->id)
        : (collect(old('categories', []))->contains($cat->id));
        @endphp
        <label class="me-3 mb-2">
            <input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ $checked ? 'checked' : '' }}>
            {{ $cat->name }}
        </label>
        @endforeach
    </div>

    <div class="mb-3">
        <label class="form-label">Gambar Utama</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @if ($portfolio->image)
        <img src="{{ Storage::url($portfolio->image) }}"
            class="img-thumbnail mt-2"
            style="max-width: 220px;">
        @endif
    </div>

    <div class="mb-4">
        <label class="form-label">Tambah Foto Galeri</label>
        <input type="file" name="photos[]" class="form-control" accept="image/*" multiple>
        <div class="form-text">Bisa pilih banyak file sekaligus. jpg, jpeg, png, webp (max 4MB per file)</div>
    </div>

    {{-- TOMBOL SIMPAN HARUS DI DALAM FORM --}}
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

<h5 class="mb-3">Galeri Saat Ini</h5>
<div class="row g-4">
    @foreach($portfolio->photos as $photo)
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card shadow-sm border-0">
            <img
                src="{{ $photo->url }}"
                data-fallback="{{ asset('images/placeholder.jpg') }}"
                onerror="this.onerror=null; this.src=this.dataset.fallback;"
                class="card-img-top"
                style="aspect-ratio:16/10;object-fit:cover;"
                alt="Foto galeri">

            <div class="card-body text-center">
                <form method="POST" action="{{ route('admin.portfolios.photos.destroy', [$portfolio, $photo]) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection