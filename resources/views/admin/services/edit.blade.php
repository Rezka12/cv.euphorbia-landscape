@extends('layouts.admin')
@section('title','Edit Layanan')

@section('content')
<form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="card card-body">
  @csrf @method('PUT')

  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $service->nama) }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $service->deskripsi) }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Gambar (opsional)</label>
    @if($service->image)
      <div class="mb-2"><img src="{{ asset('storage/'.$service->image) }}" alt="" style="height:80px"></div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/*">
  </div>

  <button class="btn btn-primary">Update</button>
  <a href="{{ route('admin.services.index') }}" class="btn btn-light">Batal</a>
</form>
@endsection
