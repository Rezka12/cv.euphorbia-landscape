<?php

namespace App\Http\Controllers\Public;

// app/Http/Controllers/Public/ServicePageController.php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServicePageController extends Controller
{
    public function index()
    {
        $services = Service::select('id','name','description','image')
            ->latest()->get();

        return view('public.services.index', compact('services'));
    }
}
