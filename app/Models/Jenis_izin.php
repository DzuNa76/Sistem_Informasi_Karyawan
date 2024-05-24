<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_izin extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    public function pengajuanIjins()
    {
        return $this->hasMany(PengajuanIzin::class);
    }
}
