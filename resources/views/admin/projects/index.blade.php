@extends('layouts.admin')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<h4 class="mb-3">Daftar Proyek</h4>

<a href="{{ route('admin.projects.create') }}" class="btn btn-primary mb-3">
  + Tambah Proyek
</a>

<table class="table table-bordered align-middle">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Status</th>
      <th style="width:260px">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($projects as $p)
      <tr>
        <td>{{ $p->name }}</td>

        <td>
          {{ $p->category_label ?? '-' }}
        </td>

        <td>
          @if ($p->status === 'in_progress')
            <span class="badge bg-warning text-dark">
              In Progress
            </span>
          @elseif ($p->status === 'done')
            <span class="badge bg-success">
              Completed
            </span>
          @else
            <span class="badge bg-secondary">
              {{ $p->status }}
            </span>
          @endif
        </td>

        <td>
          <a href="{{ route('admin.projects.edit', $p) }}"
             class="btn btn-sm btn-warning">
            Edit
          </a>

          <form action="{{ route('admin.projects.destroy', $p) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm('Hapus proyek ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">
              Hapus
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="4" class="text-center text-muted">
          Belum ada proyek
        </td>
      </tr>
    @endforelse
  </tbody>
</table>

{{ $projects->links() }}

@endsection
