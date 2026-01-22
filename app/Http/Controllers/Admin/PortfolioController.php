<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with(['categories', 'photos'])
            ->latest('id')
            ->paginate(15);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        // ✅ AMBIL SEMUA KATEGORI (tanpa filter)
        $categories = PortfolioCategory::orderBy('name')->get();

        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'client'       => ['nullable', 'string', 'max:255'],
            'location'     => ['nullable', 'string', 'max:255'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'categories'   => ['nullable', 'array'],
            'categories.*' => ['integer', Rule::exists('portfolio_categories', 'id')],
            'photos'       => ['nullable', 'array'],
            'photos.*'     => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        DB::transaction(function () use ($data, $request) {

            $portfolio = Portfolio::create([
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']) . '-' . uniqid(),
                'description' => $data['description'] ?? null,
                'client'      => $data['client'] ?? null,
                'location'    => $data['location'] ?? null,
            ]);

            // upload cover
            if ($request->hasFile('image')) {
                $portfolio->image = $request->file('image')->store('portfolios', 'public');
                $portfolio->save();
            }

            // ✅ SYNC KATEGORI
            $portfolio->categories()->sync($request->input('categories', []));

            // upload foto tambahan
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $f) {
                    $path = $f->store('portfolio_photos', 'public');
                    $portfolio->photos()->create(['path' => $path]);
                }
            }
        });

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil dibuat.');
    }

    public function edit(Portfolio $portfolio)
    {
        $portfolio->load(['categories', 'photos']);

        // ✅ AMBIL SEMUA KATEGORI
        $categories = PortfolioCategory::orderBy('name')->get();

        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'client'       => ['nullable', 'string', 'max:255'],
            'location'     => ['nullable', 'string', 'max:255'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'categories'   => ['nullable', 'array'],
            'categories.*' => ['integer', Rule::exists('portfolio_categories', 'id')],
            'photos'       => ['nullable', 'array'],
            'photos.*'     => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        DB::transaction(function () use ($portfolio, $data, $request) {

            $portfolio->update([
                'name'        => $data['name'],
                'description' => $data['description'] ?? null,
                'client'      => $data['client'] ?? null,
                'location'    => $data['location'] ?? null,
            ]);

            if ($request->hasFile('image')) {
                if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                    Storage::disk('public')->delete($portfolio->image);
                }
                $portfolio->image = $request->file('image')->store('portfolios', 'public');
                $portfolio->save();
            }

            // ✅ SYNC KATEGORI
            $portfolio->categories()->sync($request->input('categories', []));

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $f) {
                    $path = $f->store('portfolio_photos', 'public');
                    $portfolio->photos()->create(['path' => $path]);
                }
            }
        });

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroyPhoto(Portfolio $portfolio, PortfolioPhoto $photo)
    {
        abort_unless($photo->portfolio_id === $portfolio->id, 404);

        if ($photo->path && Storage::disk('public')->exists($photo->path)) {
            Storage::disk('public')->delete($photo->path);
        }

        $photo->delete();

        return back()->with('success', 'Foto dihapus.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return back()->with('success', 'Portofolio dihapus.');
    }
}
