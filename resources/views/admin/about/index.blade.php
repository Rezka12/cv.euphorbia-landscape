@extends('layouts.admin')

@section('content')
<h3>Tentang Kami</h3>

<a href="{{ route('admin.about.edit') }}" class="btn btn-primary mb-3">Edit</a>

@if($about)
    <h5>{{ $about->title }}</h5>
    <p>{{ $about->content }}</p>
@endif
@endsection
