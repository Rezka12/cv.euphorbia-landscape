<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:120']);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success','Kategori ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate(['name' => 'required|string|max:120']);
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success','Kategori diperbarui.');
    }

    public function destroy(Category $category)
    {
        // akan otomatis menghapus plants karena cascadeOnDelete di migration (jika ada)
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','Kategori dihapus.');
    }
}
