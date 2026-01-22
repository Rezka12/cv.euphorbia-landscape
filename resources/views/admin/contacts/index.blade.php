@extends('layouts.admin')
@section('title','Pesan Masuk')

@section('content')
@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<div class="card">
  <div class="card-body">
    <h5 class="mb-3">Daftar Pesan</h5>
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>HP</th>
            <th>Masuk</th>
            <th width="180">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($contacts as $c)
            <tr>
              <td>{{ $contacts->firstItem() + $loop->index }}</td>
              <td>{{ $c->name }}</td>
              <td>{{ $c->email }}</td>
              <td>{{ $c->phone ?? '-' }}</td>
              <td>{{ $c->created_at->format('d M Y H:i') }}</td>
              <td>
                <a href="{{ route('admin.contacts.show',$c) }}" class="btn btn-primary btn-sm">Lihat</a>
                <form action="{{ route('admin.contacts.destroy',$c) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesan ini?')">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center">Belum ada pesan</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{ $contacts->links() }}
  </div>
</div>
@endsection
