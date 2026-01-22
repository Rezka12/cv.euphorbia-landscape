<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plant;     // model tanaman
use App\Models\Category;  // model kategori tanaman

class PlantPageController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori buat chip
        $categories = Category::orderBy('name')->get();

        // Query dasar: tampilkan tanaman terbaru + dengan relasi kategori
        $query = Plant::with('category')->latest();

        // Baca query string ?kategori= (kita pakai ID supaya simpel & pasti ada)
        $activeCategory = null;
        if ($request->filled('kategori')) {
            $catId = (int) $request->query('kategori');
            $activeCategory = $categories->firstWhere('id', $catId);

            if ($activeCategory) {
                $query->where('category_id', $activeCategory->id);
            }
        }

        // Paginate dan pertahankan query string (biar pagination tetap terfilter)
        $plants = $query->paginate(9)->appends($request->query());

        return view('public.plants.index', compact(
            'categories',
            'plants',
            'activeCategory'
        ));
    }

    public function show(string $slug)
    {
        $plant = \App\Models\Plant::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.plants.show', compact('plant'));
    }
}
