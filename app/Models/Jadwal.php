<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $guarded = ['id'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
