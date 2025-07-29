<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kms extends Model
{
    use HasFactory;

    protected $table = 'kms';
    protected $primaryKey = 'id_kms';

    protected $fillable = [
        'id_balita',
        'tanggal_pemeriksaan',
        'usia_bulan',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'id', // ID admin atau kader pembuat
        'id_imunisasi',
    ];

    /**
     * Relasi ke balita.
     */
    public function balita()
    {
        return $this->belongsTo(Balita::class, 'id_balita');
    }

    /**
     * Relasi ke user (admin atau kader yang membuat).
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Relasi ke imunisasi.
     */
    public function imunisasi()
    {
        return $this->belongsTo(Imunisasi::class, 'id_imunisasi');
    }
    // JADI INI:
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
