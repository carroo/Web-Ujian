<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'matkul';
    protected $fillable = [
        'nama_matkul',
    ];
    function hasil() {
        return $this->belongsTo(Hasil::class);
    }
    function soal() {
        return $this->belongsTo(Soal::class);
    }
    function jurusanmatkul(){
        return $this->hasMany(jurusanmatkul::class);
    }
}
