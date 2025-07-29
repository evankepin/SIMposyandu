<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwalposyandu';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'tanggal_kegiatan',
        'waktu_kegiatan',
        'lokasi',
        'jenis_kegiatan',
        'deskripsi',
        'dibuat_oleh',
    ];
}
