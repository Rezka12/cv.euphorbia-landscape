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

<h4 class="mb-3">Edit Proyek</h4>

<form method="POST"
      action="{{ route('admin.projects.update', $project) }}"
      enctype="multipart/form-data">
  @csrf
  @method('PUT')

  {{-- Nama --}}
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $project->name) }}"
           required>
  </div>

  {{-- Deskripsi --}}
  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description"
              rows="4"
              class="form-control">{{ old('description', $project->description) }}</textarea>
  </div>

  {{-- Klien & Lokasi --}}
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Klien</label>
      <input type="text"
             name="client"
             class="form-control"
             value="{{ old('client', $project->client) }}">
    </div>
    <div class="col-md-6">
      <label class="form-label">Lokasi</label>
      <input type="text"
             name="location"
             class="form-control"
             value="{{ old('location', $project->location) }}">
    </div>
  </div>

  {{-- Kategori --}}
  <div class="mb-3 mt-3">
    <label class="form-label d-block">Kategori</label>

    @php
      $val = old('category', $project->category);
    @endphp

    <label class="me-3">
      <input type="radio"
             name="category"
             value="design-build"
             {{ $val === 'design-build' ? 'checked' : '' }}>
      Perancangan & Pembangunan
    </label>

    <label>
      <input type="radio"
             name="category"
             value="pemeliharaan"
             {{ $val === 'pemeliharaan' ? 'checked' : '' }}>
      Pemeliharaan
    </label>
  </div>

  {{-- STATUS (TANPA KONSTANTA MODEL) --}}
  <div class="mb-3">
    <label class="form-label">Status</label>

    @php
      $st = old('status', $project->status);
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
    <input type="file" name="image" class="form-control" accept="image/*">

    @if ($project->image)
      <img src="{{ $project->image_url }}"
           class="img-thumbnail mt-2"
           style="max-width:240px;">
    @endif
  </div>

  {{-- Upload Galeri --}}
  <div class="mb-4">
    <label class="form-label">Tambah Foto Galeri</label>
    <input type="file"
           name="photos[]"
           class="form-control"
           accept="image/*"
           multiple>
    <div class="form-text">
      jpg, jpeg, png, webp (max 4MB / file)
    </div>
  </div>

  <button type="submit" class="btn btn-primary">
    Simpan
  </button>
</form>

{{-- GALERI --}}
@if ($project->photos->count())
<hr class="my-4">
<h5 class="mb-3">Galeri Saat Ini</h5>

<div class="row g-4">
  @foreach($project->photos as $ph)
    <div class="col-md-6 col-xl-4">
      <div class="card">
        <img src="{{ $ph->url }}" class="card-img-top" alt="Foto">
        <div class="card-body text-center">
          <form method="POST"
                action="{{ route('admin.projects.photos.destroy', [$project, $ph]) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">
              Hapus
            </button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endif

{{-- TANDAI SELESAI --}}
@if ($project->status !== 'done')
<form class="mt-4"
      method="POST"
      action="{{ route('admin.projects.complete', $project) }}">
  @csrf
  <button class="btn btn-success">
    Tandai Selesai & Kirim ke Portofolio
  </button>
</form>
@endif

@endsection
