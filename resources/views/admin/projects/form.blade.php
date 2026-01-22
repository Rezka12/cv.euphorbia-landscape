@csrf

<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $project->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $project->description ?? '') }}</textarea>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Klien</label>
        <input type="text" name="client" class="form-control" value="{{ old('client', $project->client ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Lokasi</label>
        <input type="text" name="location" class="form-control" value="{{ old('location', $project->location ?? '') }}">
    </div>
</div>

<div class="mb-3 mt-3">
    <label class="form-label d-block">Kategori</label>
    @php $val = old('category', $project->category ?? \App\Models\Project::CATEGORY_DESIGN_BUILD); @endphp
    <label class="me-3">
        <input type="radio" name="category" value="{{ \App\Models\Project::CATEGORY_DESIGN_BUILD }}" {{ $val === \App\Models\Project::CATEGORY_DESIGN_BUILD ? 'checked' : '' }}>
        Design & Build
    </label>
    <label>
        <input type="radio" name="category" value="{{ \App\Models\Project::CATEGORY_MAINTENANCE }}" {{ $val === \App\Models\Project::CATEGORY_MAINTENANCE ? 'checked' : '' }}>
        Pemeliharaan
    </label>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    @php $st = old('status', $project->status ?? \App\Models\Project::STATUS_ACTIVE); @endphp
    <select name="status" class="form-select">
        <option value="{{ \App\Models\Project::STATUS_ACTIVE }}" {{ $st === \App\Models\Project::STATUS_ACTIVE ? 'selected' : '' }}>In Progress</option>
        <option value="{{ \App\Models\Project::STATUS_COMPLETED }}" {{ $st === \App\Models\Project::STATUS_COMPLETED ? 'selected' : '' }}>Completed</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Gambar Utama</label>
    <input type="file" name="image" class="form-control" accept="images
    @isset($project)
        @if ($project->image)
            <img src="{{ $project->image_url }}" class="img-thumbnail mt-2" style="max-width: 240px;">
        @endif
    @endisset
</div>

<div class="mb-4">
    <label class="form-label">Tambah Foto Galeri</label>
    <input type="file" name="photos[]" class="form-control" accept="image/*" multiple>
    <div class="form-text">Bisa pilih banyak file sekaligus. jpg, jpeg, png, webp (max 4MB / file)</div>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
