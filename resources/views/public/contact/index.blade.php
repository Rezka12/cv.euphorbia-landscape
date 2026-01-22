@extends('layouts.public')
@section('title','Kontak')
@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <h1 class="text-3xl font-bold mb-6">Hubungi Kami</h1>

  @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-emerald-50 text-emerald-800">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('site.contact.store') }}" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm font-medium mb-1">Nama</label>
      <input type="text" name="name" value="{{ old('name') }}"
             class="w-full border rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
      @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email') }}"
             class="w-full border rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
      @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Pesan</label>
      <textarea name="message" rows="6"
                class="w-full border rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('message') }}</textarea>
      @error('message') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <button type="submit"
            class="px-5 py-3 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">
      Kirim Pesan
    </button>
  </form>
</section>
@endsection
