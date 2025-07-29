<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Kms;
use App\Models\Balita;
use App\Models\Imunisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KmsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kms = Kms::with(['balita', 'imunisasi']) // Tambahkan relasi imunisasi
            ->when($search, function ($query) use ($search) {
                $query->whereHas('balita', function ($q) use ($search) {
                    $q->where('nama_balita', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->paginate(10);

        $balitas = Balita::all(); // kader bisa pilih semua balita
        $imunisasis = Imunisasi::all(); // Tambahkan untuk form dropdown imunisasi

        return view('kader.kms', compact('kms', 'balitas', 'imunisasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_balita'           => 'required|exists:balita,id_balita',
            'tanggal_pemeriksaan' => 'required|date',
            'usia_bulan'          => 'required|integer|min:0',
            'berat_badan'         => 'required|numeric|min:0',
            'tinggi_badan'        => 'required|numeric|min:0',
            'lingkar_kepala'      => 'nullable|numeric|min:0',
            'id_imunisasi'        => 'required|exists:imunisasi,id_imunisasi', // Validasi imunisasi
        ]);

        Kms::create([
            'id_balita'           => $request->id_balita,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'usia_bulan'          => $request->usia_bulan,
            'berat_badan'         => $request->berat_badan,
            'tinggi_badan'        => $request->tinggi_badan,
            'lingkar_kepala'      => $request->lingkar_kepala,
            'id_imunisasi'        => $request->id_imunisasi,
            'id'                  => Auth::id(), // user id pembuat
        ]);

        return back()->with('success', 'Data KMS berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kms = Kms::findOrFail($id);

        $request->validate([
            'id_balita'           => 'required|exists:balita,id_balita',
            'tanggal_pemeriksaan' => 'required|date',
            'usia_bulan'          => 'required|integer|min:0',
            'berat_badan'         => 'required|numeric|min:0',
            'tinggi_badan'        => 'required|numeric|min:0',
            'lingkar_kepala'      => 'nullable|numeric|min:0',
            'id_imunisasi'        => 'required|exists:imunisasi,id_imunisasi',
        ]);

        $kms->update([
            'id_balita'           => $request->id_balita,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'usia_bulan'          => $request->usia_bulan,
            'berat_badan'         => $request->berat_badan,
            'tinggi_badan'        => $request->tinggi_badan,
            'lingkar_kepala'      => $request->lingkar_kepala,
            'id_imunisasi'        => $request->id_imunisasi,
            'id'                  => Auth::id(),
        ]);

        return back()->with('success', 'Data KMS berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kms = Kms::findOrFail($id);
        $kms->delete();

        return back()->with('success', 'Data KMS berhasil dihapus.');
    }
}
