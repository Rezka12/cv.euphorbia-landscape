<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak Kami</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h1 class="mb-3">Kontak Kami</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('contact.store') }}">
    @csrf
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label">No. HP (opsional)</label>
        <input name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-12">
        <label class="form-label">Pesan</label>
        <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="mt-3">
      <button class="btn btn-primary">Kirim</button>
    </div>
  </form>
</div>
</body>
</html>
