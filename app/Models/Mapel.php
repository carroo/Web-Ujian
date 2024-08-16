<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $fillable = [
        'nama_mapel',
    ];
    function hasil() {
        return $this->belongsTo(Hasil::class);
    }
    function soal() {
        return $this->belongsTo(Soal::class);
    }
    function jurusanmapel(){
        return $this->hasMany(jurusanmapel::class);
    }
}
