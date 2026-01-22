@extends('layouts.admin')
@section('title','Tambah Layanan')

@section('content')
<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="card card-body">
  @csrf
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Gambar (opsional)</label>
    <input type="file" name="image" class="form-control" accept="image/*">
  </div>

  <button class="btn btn-primary">Simpan</button>
  <a href="{{ route('admin.services.index') }}" class="btn btn-light">Batal</a>
</form>
@endsection
