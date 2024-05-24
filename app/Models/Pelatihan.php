<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pelatihan',
        'type',
        'tgl_mulai',
        'tgl_selesai',
        'penyelenggara'
    ];

    public function partisipans()
    {
        return $this->hasMany(Partisipan::class);
    }
}
