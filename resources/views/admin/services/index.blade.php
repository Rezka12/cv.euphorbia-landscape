@extends('layouts.admin')
@section('title','Layanan')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Layanan</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-success">+ Tambah Layanan</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th style="width: 25%">Nama</th>
          <th style="width: 45%">Deskripsi</th>
          <th style="width: 20%">Gambar</th>
          <th style="width: 10%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($services as $service)
          <tr>
            <td class="fw-semibold">{{ $service->name }}</td>
            <td class="text-muted">{{ $service->description ?: '—' }}</td>
            <td>
              @if($service->image)
                <img src="{{ asset('storage/'.$service->image) }}"
                     alt="{{ $service->name }}"
                     class="img-thumbnail"
                     style="width:120px;height:80px;object-fit:cover;">
              @else
                <span class="text-muted">Tidak ada</span>
              @endif
            </td>
            <td>
              <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('admin.services.destroy', $service->id) }}"
                    method="POST" class="d-inline"
                    onsubmit="return confirm('Hapus layanan ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted">Belum ada layanan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
