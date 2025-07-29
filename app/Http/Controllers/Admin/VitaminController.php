<?php
// app/Http/Controllers/Admin/VitaminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vitamin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VitaminController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        $vitamins = Vitamin::with(['vendor'])
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('nama_vitamin', 'like', "%$keyword%")
                             ->orWhere('jenis_vitamin', 'like', "%$keyword%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $vendors = Vendor::all();

        return view('admin.vitamin', compact('vitamins', 'vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vitamin'   => 'required|string|max:255',
            'jenis_vitamin'  => 'required|string|max:100',
            'kandungan'      => 'required|string|max:255',
            'usia_saran'     => 'nullable|integer|min:0',
            'deskripsi'      => 'nullable|string',
            'status_aktif'   => 'required|boolean',
            'id_vendor'      => 'nullable|exists:vendor,id_vendor'
        ]);

        Vitamin::create($request->all() + ['dibuat_oleh' => Auth::id()]);

        return redirect()->back()->with('success', 'Data vitamin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $vitamin = Vitamin::findOrFail($id);

        $request->validate([
            'nama_vitamin'   => 'required|string|max:255',
            'jenis_vitamin'  => 'required|string|max:100',
            'kandungan'      => 'required|string|max:255',
            'usia_saran'     => 'nullable|integer|min:0',
            'deskripsi'      => 'nullable|string',
            'status_aktif'   => 'required|boolean',
            'id_vendor'      => 'nullable|exists:vendor,id_vendor'
        ]);

        $vitamin->update($request->all());

        return redirect()->back()->with('success', 'Data vitamin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Vitamin::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data vitamin berhasil dihapus.');
    }
}
