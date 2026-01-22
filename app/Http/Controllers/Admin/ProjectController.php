<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Portfolio;
use App\Models\ProjectPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('photos')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:in_progress,done',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|max:4096',
            'photos.*' => 'nullable|image|max:4096',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        // Simpan proyek
        $project = new Project($validated);
        $project->save();

        // Simpan foto galeri jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('projects', 'public');
                $project->photos()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dibuat.');
    }

    public function edit(Project $project)
    {
        $project->load('photos');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $oldStatus = $project->status;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:in_progress,done',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|max:4096',
            'photos.*' => 'nullable|image|max:4096',
        ]);

        // image utama
        if ($request->hasFile('image')) {
            if ($project->image) {
                \Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        // update data
        $project->update($validated);

        // galeri
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                if ($file->isValid()) {
                    $project->photos()->create([
                        'path' => $file->store('projects', 'public')
                    ]);
                }
            }
        }

        /**
         * ============================
         * AUTO MOVE (INI FIX UTAMA)
         * ============================
         * JANGAN redirect ke route POST
         * PANGGIL method complete() langsung
         */
        if (
            $oldStatus === Project::STATUS_IN_PROGRESS &&
            $validated['status'] === Project::STATUS_DONE
        ) {

            return $this->complete($project); // ✅ INI KUNCINYA
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function complete(Project $project)
    {
        DB::transaction(function () use ($project) {

            $project->load('photos');

            // pindahkan cover
            $newCover = null;
            if ($project->image) {
                $newCover = $this->moveToPortfolioDir($project->image);
            }

            // BUAT PORTOFOLIO
            $portfolio = Portfolio::create([
                'name' => $project->name,
                'slug' => \Str::slug($project->name) . '-' . uniqid(),
                'description' => $project->description,
                'client' => $project->client,
                'location' => $project->location,
                'image' => $newCover,
            ]);

            /**
             * =========================
             * 🔥 SYNC KATEGORI (KUNCI)
             * =========================
             */
            $categorySlug = match ($project->category) {
                'design-build' => 'perancangan-pembangunan',
                'pemeliharaan' => 'pemeliharaan',
                default => null,
            };

            if ($categorySlug) {
                $category = \App\Models\PortfolioCategory::where('slug', $categorySlug)->first();
                if ($category) {
                    $portfolio->categories()->sync([$category->id]);
                }
            }

            // pindahkan galeri
            foreach ($project->photos as $p) {
                $moved = $this->moveToPortfolioDir($p->path);
                $portfolio->photos()->create(['path' => $moved]);
            }

            // hapus project lama
            $project->photos()->delete();
            $project->delete();
        });

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Proyek dipindahkan ke Portofolio & dihapus dari daftar proyek.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        foreach ($project->photos as $p) {
            Storage::disk('public')->delete($p->path);
        }

        $project->photos()->delete();
        $project->delete();

        return back()->with('success', 'Proyek dihapus.');
    }

    public function destroyPhoto(Project $project, ProjectPhoto $photo)
    {
        if ((int) $photo->project_id !== (int) $project->id) {
            abort(404);
        }

        if ($photo->path && Storage::disk('public')->exists($photo->path)) {
            Storage::disk('public')->delete($photo->path);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    protected function moveToPortfolioDir(?string $path): ?string
    {
        if (!$path)
            return null;

        $disk = Storage::disk('public');
        $src = ltrim($path, '/');

        if (str_starts_with($src, 'portfolios/')) {
            return $src;
        }

        $file = basename($src);
        $dst = 'portfolios/' . $file;

        if ($disk->exists($dst)) {
            $dst = 'portfolios/' . uniqid() . '-' . $file;
        }

        if ($disk->exists($src)) {
            $disk->move($src, $dst);
            return $dst;
        }

        return $dst;
    }
}
