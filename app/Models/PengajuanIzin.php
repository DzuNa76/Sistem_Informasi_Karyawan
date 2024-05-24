<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanIzin extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawai_id',
        'tgl_pengajuan',
        'jenisIzin_id',
        'status'
    ];

    public function jenisIjins()
    {
        return $this->belongsTo(Jenis_izin::class, 'jenisIzin_id');
    }
    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
