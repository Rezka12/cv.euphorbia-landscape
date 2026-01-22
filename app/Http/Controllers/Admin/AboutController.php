<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        return view('admin.about.index', compact('about'));
    }

    public function edit()
    {
        $about = About::first();

        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
        ]);

        $about = About::first() ?? new About();
        $about->fill($data);

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $about->image = $request->file('image')->store('abouts', 'public');
        }

        $about->save();

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Tentang Kami berhasil diperbarui.');
    }
}
