<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $table = 'balita';
    protected $primaryKey = 'id_balita';

    protected $fillable = [
        'nama_balita',
        'nik_balita',
        'tanggal_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'berat_lahir',
        'panjang_lahir',
        'id', // foreign key ke users
    ];

    // ✅ Relasi ke tabel users
    public function orangtua()
    {
        return $this->belongsTo(User::class, 'id'); // 'id' di sini adalah foreign key ke tabel users
    }
    // app/Models/Balita.php

    public function kms()
    {
        return $this->hasMany(\App\Models\Kms::class, 'id_balita');
    }

}
