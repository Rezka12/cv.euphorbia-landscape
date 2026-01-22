<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectPageController extends Controller
{
    public function index(Request $request)
    {
        // chips kategori pada URL: ?category=design-build|pemeliharaan
        $slug = $request->query('category', 'all');

        $categories = [
            'design-build' => 'Landscape Construction',
            'pemeliharaan' => 'Landscape Maintenance',
        ];

        $query = Project::latest();

        if ($slug !== 'all' && array_key_exists($slug, $categories)) {
            $query->where('category', $slug);
        }

        $projects = $query->paginate(9)->withQueryString();

        // hero image full-bleed
        $hero = asset('images/heroes/projects.jpg');

        return view('public.projects.index', compact('projects', 'categories', 'slug', 'hero'));
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->with('photos')->firstOrFail();
        $hero    = $project->image_url;

        return view('public.projects.show', compact('project', 'hero'));
    }
}
