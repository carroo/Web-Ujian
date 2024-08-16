<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table = 'ujian';
    protected $fillable = [
        'guru_id',
        'mapel_id',
        'nama_ujian',
        'jumlah_soal',
        'waktu',
        'jenis',
        'token',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
    function guru() {
        return $this->belongsTo(User::class,'guru_id','id');
    }
    function mapel() {
        return $this->belongsTo(mapel::class);
    }
    function hasil() {
        return $this->hasMany(Hasil::class);
    }
}
