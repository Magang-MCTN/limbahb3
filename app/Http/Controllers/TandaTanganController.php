<?php

namespace App\Http\Controllers;

use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TandaTanganController extends Controller
{
    public function create()
    {
        // Ambil informasi pengguna yang sedang login
        $user = Auth::user();

        // Ambil informasi tanda tangan sesuai dengan pengguna yang sedang login
        $tandaTangan = TandaTangan::where('id_user', $user->id)->first();

        return view('dashboard.ttd.create', compact('tandaTangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanda_tangan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        $path = $request->file('tanda_tangan')->store('public/tanda_tangan');
        $fileName = str_replace('public/', '', $path);

        $tandaTangan = TandaTangan::updateOrCreate(
            ['id_user' => $user->id],
            ['path' => $fileName]
        );

        return redirect()->route('tanda_tangan.create')->with('success', 'Tanda tangan berhasil diunggah.');
    }

    public function edit()
    {
        $user = Auth::user();
        $tandaTangan = TandaTangan::where('user_id', $user->id)->first();

        return view('dashboard.ttd.edit', compact('tandaTangan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tanda_tangan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        $path = $request->file('tanda_tangan')->store('tanda_tangan');

        TandaTangan::updateOrCreate(
            ['user_id' => $user->id],
            ['path' => $path]
        );

        return redirect()->route('tanda_tangan.create')->with('success', 'Tanda tangan berhasil diperbarui.');
    }
}
