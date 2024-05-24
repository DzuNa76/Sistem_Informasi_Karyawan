<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_absensi', 'status', 'durasi', 'started_at', 'closed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'closed_at' => 'datetime'
    ];

    public function recordAbsensis()
    {
        return $this->hasMany(RecordAbsensi::class);
    }
}
