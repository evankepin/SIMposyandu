<?php
// app/Models/Vitamin.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    use HasFactory;

    protected $table = 'vitamin';
    protected $primaryKey = 'id_vitamin';

    protected $fillable = [
        'nama_vitamin',
        'jenis_vitamin',
        'kandungan',
        'usia_saran',
        'deskripsi',
        'status_aktif',
        'id_vendor',
        'dibuat_oleh'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor');
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
