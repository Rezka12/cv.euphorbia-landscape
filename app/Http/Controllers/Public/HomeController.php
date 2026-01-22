<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Project;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Plant;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $about = About::first();

        // 3 proyek dengan status IN PROGRESS
        $projects = Project::query()
            ->where('status', Project::STATUS_IN_PROGRESS)
            ->latest()
            ->take(3)
            ->get();

        // layanan (maks 6), aman kalau kolom order_column tidak ada
        $services = Service::when(
            Schema::hasColumn('services', 'order_column'),
            fn ($q) => $q->orderBy('order_column', 'asc')
        )->latest()->take(6)->get();

        $portfolios = Portfolio::latest()->take(3)->get();
        $plants     = Plant::latest()->take(3)->get();

        return view(
            'public.home',
            compact('about', 'projects', 'services', 'portfolios', 'plants')
        );
    }
}
