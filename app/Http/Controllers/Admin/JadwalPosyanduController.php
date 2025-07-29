<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;
        $jadwals = JadwalPosyandu::when($keyword, function ($query) use ($keyword) {
            return $query->where('lokasi', 'like', "%$keyword%")
                         ->orWhere('jenis_kegiatan', 'like', "%$keyword%");
        })->orderBy('tanggal_kegiatan', 'desc')->paginate(10);

        return view('admin.jadwal', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'waktu_kegiatan' => 'required',
            'lokasi' => 'required|string',
            'jenis_kegiatan' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        JadwalPosyandu::create([
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'waktu_kegiatan' => $request->waktu_kegiatan,
            'lokasi' => $request->lokasi,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'deskripsi' => $request->deskripsi,
            'dibuat_oleh' => Auth::id(),
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);

        $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'waktu_kegiatan' => 'required',
            'lokasi' => 'required|string',
            'jenis_kegiatan' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        $jadwal->update($request->only([
            'tanggal_kegiatan', 'waktu_kegiatan', 'lokasi', 'jenis_kegiatan', 'deskripsi'
        ]));

        return back()->with('success', 'Jadwal berhasil diupdate!');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $jadwal->delete();

        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
