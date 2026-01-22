@extends('layouts.admin')
@section('title','Detail Pesan')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="mb-3">Detail Pesan</h5>

    <dl class="row">
      <dt class="col-sm-3">Nama</dt>
      <dd class="col-sm-9">{{ $contact->name }}</dd>

      <dt class="col-sm-3">Email</dt>
      <dd class="col-sm-9">{{ $contact->email }}</dd>

      <dt class="col-sm-3">HP</dt>
      <dd class="col-sm-9">{{ $contact->phone ?? '-' }}</dd>

      <dt class="col-sm-3">Masuk</dt>
      <dd class="col-sm-9">{{ $contact->created_at->format('d M Y H:i') }}</dd>

      <dt class="col-sm-3">Pesan</dt>
      <dd class="col-sm-9" style="white-space: pre-line">{{ $contact->message }}</dd>
    </dl>

    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Kembali</a>
    <form action="{{ route('admin.contacts.destroy',$contact) }}" method="POST" class="d-inline">
      @csrf @method('DELETE')
      <button class="btn btn-danger" onclick="return confirm('Hapus pesan ini?')">Hapus</button>
    </form>
  </div>
</div>
@endsection
