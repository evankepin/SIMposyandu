<?php
// app/Http/Controllers/Orangtua/JadwalController.php
namespace App\Http\Controllers\Orangtua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPosyandu;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;
        $jadwals = JadwalPosyandu::when($keyword, function ($query) use ($keyword) {
                return $query->where('lokasi', 'like', "%$keyword%")
                             ->orWhere('jenis_kegiatan', 'like', "%$keyword%");
            })
            ->orderBy('tanggal_kegiatan', 'asc')
            ->paginate(10);

        return view('orangtua.jadwal', compact('jadwals'));
    }
}
