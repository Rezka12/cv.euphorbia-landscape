@extends('layouts.admin')
@section('title','Kategori Tanaman')

@section('content')
<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">+ Tambah Kategori</a>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th><th>Nama</th><th width="160">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($categories as $c)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $c->name }}</td>
        <td>
          <a class="btn btn-warning btn-sm" href="{{ route('admin.categories.edit',$c) }}">Edit</a>
          <form class="d-inline" method="POST" action="{{ route('admin.categories.destroy',$c) }}">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="3" class="text-center">Belum ada kategori</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
