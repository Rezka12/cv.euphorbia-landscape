<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function index()
    {
        $about = About::first();

        // URL gambar sampul (fallback kalau belum ada)
        $cover = $about && $about->image
            ? Storage::url($about->image)
            : asset('images/cover-about.jpg');

        // “Layanan utama / ruang lingkup” buat kotak-kotak highlight
        $highlights = [
            ['title' => 'Design & Build',           'desc' => 'Perancangan & pembangunan taman: perkantoran, pabrik, ruang terbuka hijau, rumah tinggal, indoor.'],
            ['title' => 'Landscape Construction',   'desc' => 'Konstruksi taman untuk area perkantoran, perumahan, hotel, pabrik, sekolah, rumah sakit.'],
            ['title' => 'Maintenance',              'desc' => 'Perawatan taman & konsultasi untuk kawasan permukiman dan komersial.'],
            ['title' => 'Indoor Plant',             'desc' => 'Sewa & pembuatan taman indoor untuk kantor, pabrik, pameran, rapat/acara.'],
            ['title' => 'Plant Supplier',           'desc' => 'Pohon pelindung, pohon buah, perdu, semak, pupuk kandang, material tanaman.'],
            ['title' => 'Nursery',                  'desc' => 'Bibit tanaman hias, buah, perkebunan, dan pohon.'],
        ];

        return view('public.about', compact('about', 'cover', 'highlights'));
    }
}
