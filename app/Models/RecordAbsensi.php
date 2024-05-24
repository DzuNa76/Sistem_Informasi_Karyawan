<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordAbsensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'absensi_id',
        'pegawai_id',
        'status',
    ];

    public function absensis()
    {
        return $this->belongsTo(Absensi::class, 'pegawai_id');
    }
    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
