@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<a href="{{ route('admin.plants.create') }}" class="btn btn-success mb-3">+ Tambah Tanaman</a>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Gambar</th>
      <th>Harga</th>
      <th width="200">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($plants as $p)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $p->name }}</td>
      <td>{{ $p->category?->name }}</td>
      <td>@if($p->image) <img src="{{ asset('storage/'.$p->image) }}" width="90"> @endif</td>
      <td>{{ $p->price ? number_format($p->price,0,',','.') : '-' }}</td>
      <td>
        <a class="btn btn-warning btn-sm" href="{{ route('admin.plants.edit',$p) }}">Edit</a>
        <form class="d-inline" method="POST" action="{{ route('admin.plants.destroy',$p) }}">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus tanaman ini?')">Hapus</button>
        </form>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="6" class="text-center">Belum ada tanaman</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection