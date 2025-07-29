<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\User;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        $balitas = Balita::with('orangtua')
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('nama_balita', 'like', "%$keyword%")
                             ->orWhere('nik_balita', 'like', "%$keyword%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $orangtuas = User::where('role', 'orangtua')->get();

        return view('admin.balita', compact('balitas', 'orangtuas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_balita'     => 'required|string|max:255',
            'nik_balita'      => 'required|string|max:20|unique:balita,nik_balita',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'golongan_darah'  => 'nullable|string|max:3',
            'berat_lahir'     => 'nullable|numeric|min:0',
            'panjang_lahir'   => 'nullable|numeric|min:0',
            'id'              => 'required|exists:users,id', // orang tua
        ]);

        Balita::create($request->all());

        return redirect()->back()->with('success', 'Data balita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $balita = Balita::findOrFail($id);

        $request->validate([
            'nama_balita'     => 'required|string|max:255',
            'nik_balita'      => 'required|string|max:20|unique:balita,nik_balita,' . $id . ',id_balita',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'golongan_darah'  => 'nullable|string|max:3',
            'berat_lahir'     => 'nullable|numeric|min:0',
            'panjang_lahir'   => 'nullable|numeric|min:0',
            'id'              => 'required|exists:users,id',
        ]);

        $balita->update($request->all());

        return redirect()->back()->with('success', 'Data balita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $balita = Balita::findOrFail($id);
        $balita->delete();

        return redirect()->back()->with('success', 'Data balita berhasil dihapus.');
    }
}
