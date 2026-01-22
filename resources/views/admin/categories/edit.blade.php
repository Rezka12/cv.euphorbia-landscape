@extends('layouts.admin')
@section('title','Edit Kategori')

@section('content')
<form method="POST" action="{{ route('admin.categories.update',$category) }}">
  @csrf @method('PUT')
  <div class="mb-3">
    <label class="form-label">Nama Kategori</label>
    <input name="name" value="{{ old('name',$category->name) }}" class="form-control @error('name') is-invalid @enderror" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <button class="btn btn-primary">Update</button>
  <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
