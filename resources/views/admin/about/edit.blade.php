@extends('layouts.admin')

@section('content')
<h4>Edit Tentang Kami</h4>

<form method="POST"
      action="{{ route('admin.about.update') }}"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text"
               name="title"
               class="form-control"
               value="{{ old('title', $about->title ?? 'Tentang Kami') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description"
                  class="form-control"
                  rows="7">{{ old('description', $about->description ?? '') }}</textarea>
        <small class="text-muted">
            Mendukung HTML: &lt;b&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;
        </small>
    </div>

    <div class="mb-3">
        <label class="form-label">Gambar Hero</label>
        <input type="file" name="image" class="form-control">

        @if(!empty($about?->image))
            <img src="{{ asset('storage/'.$about->image) }}"
                 class="img-thumbnail mt-2"
                 style="max-width: 300px;">
        @endif
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection
