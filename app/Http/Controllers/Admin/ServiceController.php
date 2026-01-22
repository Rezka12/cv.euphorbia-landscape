<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mapping ke kolom DB
        $data = [
            'name'        => $validated['nama'],
            'description' => $validated['deskripsi'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public'); // storage/services/...
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mapping ke kolom DB
        $data = [
            'name'        => $validated['nama'],
            'description' => $validated['deskripsi'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();

        return back()->with('success', 'Layanan dihapus.');
    }
}
