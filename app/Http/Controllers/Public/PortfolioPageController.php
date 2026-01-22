<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioPageController extends Controller
{
    /**
     * Menu filter publik (slug => label UI).
     * Slug = dipakai query
     * Label = teks di frontend (Inggris)
     */
    private array $menu = [
        'perancangan-pembangunan' => [
            'label' => 'Landscape Construction',
        ],
        'pemeliharaan' => [
            'label' => 'Landscape Maintenance',
        ],
    ];

    /**
     * Alias agar URL lama tetap jalan.
     * SEMUA value HARUS slug valid.
     */
    private array $aliases = [
        // Inggris → slug DB
        'landscape-construction' => 'perancangan-pembangunan',
        'landscape-maintenance' => 'pemeliharaan',

        // Alternatif
        'design-build' => 'perancangan-pembangunan',
        'maintenance' => 'pemeliharaan',
    ];

    /**
     * GET /portfolio
     */
    public function index(Request $request)
    {
        $rawCategory = trim((string) $request->query('category', ''));
        $active = $this->normalizeToSlug($rawCategory);

        $query = Portfolio::query()
            ->with(['categories', 'photos']);

        if ($active && isset($this->menu[$active])) {
            $query->whereHas('categories', function ($q) use ($active) {
                $q->where('slug', $active);
            });
        }

        $portfolios = $query
            ->latest()
            ->paginate(9);

        return view('public.portfolio.index', [
            'portfolios' => $portfolios,
            'menu' => $this->menu,
            'active' => $active ?? 'all',
        ]);
    }

    /**
     * GET /portfolio/{slug}
     */
    public function show(string $slug)
    {
        $portfolio = Portfolio::with(['categories', 'photos'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.portfolio.show', compact('portfolio'));
    }

    /**
     * Normalisasi input category ke slug valid.
     */
    private function normalizeToSlug(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        $lower = Str::of($value)->lower()->trim()->toString();

        // sudah slug valid
        if (isset($this->menu[$lower])) {
            return $lower;
        }

        // slug-kan input
        $slug = Str::slug($value);

        // cek alias
        if (isset($this->aliases[$slug])) {
            return $this->aliases[$slug];
        }

        return null;
    }
}
