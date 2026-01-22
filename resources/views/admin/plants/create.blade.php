@extends('layouts.admin')
@section('title','Tambah Tanaman')

@section('content')
<form method="POST" action="{{ route('admin.plants.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
      <option value="">-- Pilih Kategori --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Nama Tanaman</label>
    <input name="name" class="form-control @error('name') is-invalid @enderror" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"></textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Harga (opsional)</label>
    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror">
    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Gambar (opsional)</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <button class="btn btn-primary">Simpan</button>
  <a href="{{ route('admin.plants.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
