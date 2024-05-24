<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiKerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawai_id',
        'tgl_evaluasi',
        'nama_reviewer',
        'nilai_kinerja',
        'comments',
    ];

    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
