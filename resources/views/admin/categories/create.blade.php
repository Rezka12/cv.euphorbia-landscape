@extends('layouts.admin')
@section('title','Tambah Kategori')

@section('content')
<form method="POST" action="{{ route('admin.categories.store') }}">
  @csrf
  <div class="mb-3">
    <label class="form-label">Nama Kategori</label>
    <input name="name" class="form-control @error('name') is-invalid @enderror" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <button class="btn btn-primary">Simpan</button>
  <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
