<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawai_id',
        'bulan',
        'tahun',
        'nama_tunjangan',
        'nominal',
        'tgl_diterima',
        'status',
    ];
    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
