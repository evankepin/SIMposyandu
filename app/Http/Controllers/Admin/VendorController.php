<?php
// app/Http/Controllers/Admin/VendorController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $vendors = Vendor::when($search, function($query) use ($search) {
                return $query->where('nama_vendor', 'like', "%$search%")
                             ->orWhere('kontak', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.vendor', compact('vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'jenis_vendor' => 'required|in:vitamin,imunisasi,gabungan,vaksin',
        ]);

        Vendor::create($request->all());

        return redirect()->back()->with('success', 'Vendor berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $request->validate([
            'nama_vendor' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'jenis_vendor' => 'required|in:vitamin,imunisasi,gabungan,vaksin',
        ]);

        $vendor->update($request->all());

        return redirect()->back()->with('success', 'Vendor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->back()->with('success', 'Vendor berhasil dihapus.');
    }
}
