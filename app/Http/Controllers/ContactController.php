<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function form()
    {
        return view('public.contact'); // halaman form
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($data);

        return back()->with('success', 'Terima kasih! Pesan Anda sudah terkirim.');
    }
}