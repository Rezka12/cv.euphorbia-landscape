@extends('layouts.admin')
{{-- @section('title','Dashboard') --}}

@section('content')
<h1 class="mb-4">Selamat datang, Admin 👋</h1>

<div class="row g-3">
  <div class="col-md-4">
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title mb-2">Layanan</h5>
      <a href="{{ url('/admin/services') }}" class="btn btn-primary btn-sm">Kelola</a>
    </div></div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title mb-2">Portofolio</h5>
      <a href="{{ url('/admin/portfolios') }}" class="btn btn-primary btn-sm">Kelola</a>
    </div></div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title mb-2">Proyek</h5>
      <a href="{{ url('/admin/projects') }}" class="btn btn-primary btn-sm">Kelola</a>
    </div></div>
  </div>
</div>
@endsection
