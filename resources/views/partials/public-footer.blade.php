<footer class="bg-green-700 text-white py-10 mt-16 relative z-10">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="text-center md:text-left">
      <h3 class="font-bold text-lg mb-3">CV Euphorbia LandScape</h3>
      <p class="text-sm">
        Spesialis dalam Landscape Design & Build, Maintenance, dan Supplier Tanaman Hias & Indoor Plant.
      </p>
    </div>

    <div class="text-center md:text-left">
      <h4 class="font-semibold mb-3">Navigasi</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="{{ route('site.home') }}" class="hover:underline">Beranda</a></li>
        <li><a href="{{ route('site.projects') }}" class="hover:underline">Proyek</a></li>
        <li><a href="{{ route('site.portfolio') }}" class="hover:underline">Portofolio</a></li>
        <li><a href="{{ route('site.plants') }}" class="hover:underline">Tanaman</a></li>
        <li><a href="{{ route('site.about') }}" class="hover:underline">Tentang</a></li>
        <li><a href="{{ route('site.contact') }}" class="hover:underline">Kontak</a></li>
      </ul>
    </div>

    <div class="text-center md:text-left">
      <h4 class="font-semibold mb-3">Kontak</h4>
      <ul class="text-sm space-y-1">
        <li>📞 0812-3456-7890</li>
        <li>📧 info@euphorbialandscape.co.id</li>
        <li>📍 Bandung, Indonesia</li>
      </ul>
    </div>
  </div>

  <div class="text-center mt-10 text-sm text-white/70">
    &copy; {{ date('Y') }} CV Euphorbia LandScape. All rights reserved.
  </div>
</footer>
