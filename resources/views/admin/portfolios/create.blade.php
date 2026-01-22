@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0">Tambah Portofolio</h1>
  <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="6" class="form-control">{{ old('description') }}</textarea>
  </div>

  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Klien</label>
      <input type="text" name="client" class="form-control" value="{{ old('client') }}">
    </div>
    <div class="col-md-6">
      <label class="form-label">Lokasi</label>
      <input type="text" name="location" class="form-control" value="{{ old('location') }}">
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

  <hr>

  <div class="mb-3">
    <label class="form-label">Gambar Utama</label>
    <input type="file" name="image" class="form-control">
    <div class="form-text">jpg, jpeg, png, webp (max 4MB)</div>
  </div>

  <div class="mb-4">
    <label class="form-label">Foto Tambahan (boleh banyak)</label>
    <input type="file" name="photos[]" class="form-control" multiple>
    <div class="form-text">Bisa pilih banyak file sekaligus.</div>
  </div>

  <button class="btn btn-primary">Simpan</button>
</form>
@endsection