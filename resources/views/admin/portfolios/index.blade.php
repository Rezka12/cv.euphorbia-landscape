@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Portofolio</h3>
  <a href="{{ route('admin.portfolios.create') }}" class="btn btn-success">+ Tambah Portofolio</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th style="width:60px">#</th>
      <th>Nama</th>
      <th>Deskripsi</th>
      <th style="width:160px">Gambar</th>
      <th style="width:220px">Kategori</th>
      <th style="width:160px">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($portfolios as $p)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $p->name }}</td>
      <td>{{ $p->description }}</td>
      <td>
        @if($p->image)
        <img src="{{ asset('storage/'.$p->image) }}" alt="" class="img-fluid" style="max-height:80px">
        @else
        —
        @endif
      </td>
      <td>
        @forelse($p->categories as $c)
        <span class="badge text-bg-secondary me-1">{{ $c->name }}</span>
        @empty
        <span class="text-muted">—</span>
        @endforelse
      </td>
      <td>
        <a href="{{ route('admin.portfolios.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>
        <form class="d-inline" action="{{ route('admin.portfolios.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus portofolio ini?')">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger btn-sm">Hapus</button>
        </form>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="6" class="text-center text-muted">Belum ada data.</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection