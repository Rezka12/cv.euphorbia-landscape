@extends('layouts.admin')

@section('content')
<h3 class="mb-3">Pindahkan ke Portofolio</h3>

<div class="card">
  <div class="card-body">
    <div class="mb-3">
      <div class="fw-semibold">Proyek</div>
      <div>{{ $project->name }}</div>
      @if($project->image)
        <img src="{{ asset('storage/'.$project->image) }}" class="mt-2 rounded" style="width:240px;height:160px;object-fit:cover;">
      @endif
    </div>

    <form method="POST" action="{{ route('admin.projects.complete', $project) }}">
      @csrf

      <div class="mb-3">
        <label class="form-label">Pilih Kategori Portofolio <span class="text-muted">(boleh lebih dari satu)</span></label>
        <select name="categories[]" class="form-control" multiple size="6">
          @foreach($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
          @endforeach
        </select>
        @error('categories') <div class="text-danger small">{{ $message }}</div> @enderror
        @error('categories.*') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-success">Pindahkan</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
