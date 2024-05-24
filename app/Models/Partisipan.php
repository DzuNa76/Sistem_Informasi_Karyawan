<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partisipan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'pelatihan_id',
        'status',
        'tgl_selesai',
    ];

    public function pelatihans()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }
    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
