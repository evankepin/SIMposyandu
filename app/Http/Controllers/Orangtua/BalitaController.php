<?php

namespace App\Http\Controllers\Orangtua;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Balita;

class BalitaController extends Controller
{
    public function index()
    {
        $balitas = Balita::with(['kms.imunisasi']) // eager load KMS dan imunisasi
                    ->where('id', Auth::id()) // pastikan pakai kolom yang sesuai
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('orangtua.balita', compact('balitas'));
    }
}
