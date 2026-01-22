<footer class="mt-20 bg-gradient-to-b from-emerald-900 to-emerald-700 text-white">
  {{-- blok hijau (footer utama) --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid gap-10 md:grid-cols-4">

    {{-- Tentang Kami --}}
    <div>
      <h3 class="text-xl font-semibold mb-3">Tentang Kami</h3>
      <p class="text-white/90 leading-relaxed">
        Euphorbia LandScape — profesional landscape & nursery. Fokus pada kualitas tanaman,
        ketepatan waktu, dan hasil rapi.
      </p>
    </div>

    {{-- Informasi --}}
    <div>
      <h3 class="text-xl font-semibold mb-3">Informasi</h3>
      <ul class="space-y-2 text-white/90">
        <li><a href="{{ route('site.about') }}" class="hover:text-white">Tentang Kami</a></li>
        <li><a href="{{ route('site.contact') }}" class="hover:text-white">Kontak</a></li>
      </ul>
    </div>

    {{-- Layanan (mengganti "Kontraktor Taman") --}}
    <div>
      <h3 class="text-xl font-semibold mb-3">Layanan</h3>
      <ul class="space-y-2 text-white/90">
        <li><a href="{{ route('site.services') }}" class="hover:text-white">Lihat semua layanan</a></li>
      </ul>
    </div>

    {{-- Kontak (tetap) --}}
    <div>
      <h3 class="text-xl font-semibold mb-3">Kontak</h3>
      <ul class="space-y-2 text-white/90">
        <li>Email: <a href="mailto:info@domainmu.com" class="hover:text-white">info@domainmu.com</a></li>
        <li>Telepon/WA: 08xx-xxxx-xxxx</li>
      </ul>
    </div>
  </div>

  {{-- bar copyright gradasi HITAM --}}
  <div class="bg-gradient-to-r from-black via-neutral-900 to-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center text-sm text-white/85">
      © {{ date('Y') }} Euphorbia LandScape. TheMans Co.
    </div>
  </div>
</footer>