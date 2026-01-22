<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactPageController extends Controller
{
    // Tampilkan halaman kontak
    public function index()
    {
        return view('public.contact.index');
    }

    // Proses form kontak
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan menghubungi Anda segera!');
    }
}
