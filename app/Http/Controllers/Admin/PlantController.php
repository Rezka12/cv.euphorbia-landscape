<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::with('category')->latest()->get();
        return view('admin.plants.index', compact('plants'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.plants.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:160',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('plants', 'public');
        }

        Plant::create($data);
        return redirect()->route('admin.plants.index')->with('success','Tanaman ditambahkan.');
    }

    public function edit(Plant $plant)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.plants.edit', compact('plant','categories'));
    }

    public function update(Request $request, Plant $plant)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:160',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($plant->image) {
                Storage::disk('public')->delete($plant->image);
            }
            $data['image'] = $request->file('image')->store('plants', 'public');
        }

        $plant->update($data);
        return redirect()->route('admin.plants.index')->with('success','Tanaman diperbarui.');
    }

    public function destroy(Plant $plant)
    {
        if ($plant->image) {
            Storage::disk('public')->delete($plant->image);
        }
        $plant->delete();
        return redirect()->route('admin.plants.index')->with('success','Tanaman dihapus.');
    }
}
