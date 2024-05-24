<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'jk',
        'ttl',
        'alamat',
        'no_telp',
        'email',
        'jabatan'
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pendidikans()
    {
        return $this->hasMany(Pendidikan::class);
    }

    public function gajis()
    {
        return $this->hasMany(Gaji::class);
    }

    public function tunjangans()
    {
        return $this->hasMany(Tunjangan::class);
    }

    public function recordAbsensis()
    {
        return $this->hasMany(RecordAbsensi::class);
    }

    public function pengajuanIjins()
    {
        return $this->hasMany(PengajuanIzin::class);
    }

    public function evaluasiKerjas()
    {
        return $this->hasMany(EvaluasiKerja::class);
    }
}
