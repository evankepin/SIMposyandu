<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imunisasi;
use App\Models\Vitamin;
use Illuminate\Support\Facades\Auth;

class ImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $imunisasis = Imunisasi::with('vitamin')
            ->when($search, function ($q) use ($search) {
                $q->where('nama_imunisasi', 'like', "%$search%");
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        $vitamins = Vitamin::all();

        return view('admin.imunisasi', compact('imunisasis', 'vitamins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_imunisasi' => 'required',
            'jenis_imunisasi' => 'required',
            'usia_minimal' => 'nullable|integer|min:0',
            'usia_maksimal' => 'nullable|integer|min:0',
            'status_aktif' => 'required|boolean',
            'id_vitamin' => 'nullable|exists:vitamin,id_vitamin',
        ]);

        Imunisasi::create(array_merge(
            $request->all(),
            ['dibuat_oleh' => Auth::id()]
        ));

        return back()->with('success', 'Data imunisasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $imunisasi = Imunisasi::findOrFail($id);

        $request->validate([
            'nama_imunisasi' => 'required',
            'jenis_imunisasi' => 'required',
            'usia_minimal' => 'nullable|integer|min:0',
            'usia_maksimal' => 'nullable|integer|min:0',
            'status_aktif' => 'required|boolean',
            'id_vitamin' => 'nullable|exists:vitamin,id_vitamin',
        ]);

        $imunisasi->update($request->all());

        return back()->with('success', 'Data imunisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Imunisasi::findOrFail($id)->delete();
        return back()->with('success', 'Data imunisasi berhasil dihapus.');
    }
}

