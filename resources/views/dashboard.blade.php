@extends('layouts.admin')
@section('title','Dashboard')

@section('content')
  <h1 class="mb-4">Selamat datang, {{ auth()->user()->name ?? 'Admin' }} 👋</h1>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Layanan</h5>
          <p class="text-muted mb-3">Kelola daftar layanan yang tersedia.</p>
          <a href="{{ route('admin.services.index') }}" class="btn btn-primary mt-auto">Kelola</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Portofolio</h5>
          <p class="text-muted mb-3">Tambahkan & update portofolio perusahaan.</p>
          <a href="{{ route('admin.portfolios.index') }}" class="btn btn-primary mt-auto">Kelola</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Proyek</h5>
          <p class="text-muted mb-3">Lihat proyek berjalan & yang sudah selesai.</p>
          <a href="{{ route('admin.projects.index') }}" class="btn btn-primary mt-auto">Kelola</a>
        </div>
      </div>
    </div>
  </div>
@endsection
