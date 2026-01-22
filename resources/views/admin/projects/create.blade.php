@extends('layouts.admin')

@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h4 class="mb-3">Tambah Proyek</h4>

<form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
  @csrf

  {{-- Nama --}}
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name') }}" required>
  </div>

  {{-- Deskripsi --}}
  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4"
              class="form-control">{{ old('description') }}</textarea>
  </div>

  {{-- Klien & Lokasi --}}
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Klien</label>
      <input type="text" name="client" class="form-control"
             value="{{ old('client') }}">
    </div>
    <div class="col-md-6">
      <label class="form-label">Lokasi</label>
      <input type="text" name="location" class="form-control"
             value="{{ old('location') }}">
    </div>
  </div>

  {{-- Kategori --}}
  <div class="mb-3 mt-3">
    <label class="form-label d-block">Kategori</label>

    @php
      use App\Models\Project;
      $cat = old('category', Project::CATEGORY_DESIGN_BUILD);
    @endphp

    <label class="me-3">
      <input type="radio" name="category"
             value="{{ Project::CATEGORY_DESIGN_BUILD }}"
             {{ $cat === Project::CATEGORY_DESIGN_BUILD ? 'checked' : '' }}>
      Perancangan & Pembangunan
    </label>

    <label>
      <input type="radio" name="category"
             value="{{ Project::CATEGORY_MAINTENANCE }}"
             {{ $cat === Project::CATEGORY_MAINTENANCE ? 'checked' : '' }}>
      Pemeliharaan
    </label>
  </div>

  {{-- STATUS (INI YANG KRUSIAL) --}}
  <div class="mb-3">
    <label class="form-label">Status</label>

    @php
      $st = old('status', 'in_progress');
    @endphp

    <select name="status" class="form-select">
      <option value="in_progress" {{ $st === 'in_progress' ? 'selected' : '' }}>
        In Progress
      </option>
      <option value="done" {{ $st === 'done' ? 'selected' : '' }}>
        Completed
      </option>
    </select>
  </div>

  {{-- Gambar Utama --}}
  <div class="mb-3">
    <label class="form-label">Gambar Utama</label>
    <input type="file" name="image"
           class="form-control" accept="image/*">
  </div>

  {{-- Galeri --}}
  <div class="mb-4">
    <label class="form-label">Tambah Foto Galeri</label>
    <input type="file" name="photos[]"
           class="form-control" accept="image/*" multiple>
    <div class="form-text">
      jpg, jpeg, png, webp (max 4MB / file)
    </div>
  </div>

  <button type="submit" class="btn btn-primary">
    Simpan
  </button>
</form>

@endsection
