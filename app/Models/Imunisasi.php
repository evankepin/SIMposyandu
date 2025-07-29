<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasi';
    protected $primaryKey = 'id_imunisasi';

    protected $fillable = [
        'nama_imunisasi',
        'jenis_imunisasi',
        'usia_minimal',
        'usia_maksimal',
        'deskripsi',
        'status_aktif',
        'id_vitamin',
        'dibuat_oleh',
    ];

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class, 'id_vitamin');
    }
}