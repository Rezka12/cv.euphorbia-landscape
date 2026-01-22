@extends('layouts.admin')
@section('title','Edit Tanaman')

@section('content')
<form method="POST" action="{{ route('admin.plants.update',$plant) }}" enctype="multipart/form-data">
  @csrf @method('PUT')

  <div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(old('category_id',$plant->category_id)==$c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Nama Tanaman</label>
    <input name="name" value="{{ old('name',$plant->name) }}" class="form-control @error('name') is-invalid @enderror" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description',$plant->description) }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Harga (opsional)</label>
    <input type="number" step="0.01" name="price" value="{{ old('price',$plant->price) }}" class="form-control @error('price') is-invalid @enderror">
    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Gambar (opsional)</label>
    @if($plant->image)
      <div class="mb-2"><img src="{{ asset('storage/'.$plant->image) }}" width="120"></div>
    @endif
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <button class="btn btn-primary">Update</button>
  <a href="{{ route('admin.plants.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
