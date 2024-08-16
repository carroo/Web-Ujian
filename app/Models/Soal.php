<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $table = 'soal';
    protected $fillable = [
        'guru_id',
        'mapel_id',
        'bobot',
        'gambar_soal',
        'soal',
        'tipe',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'gambar_a',
        'gambar_b',
        'gambar_c',
        'gambar_d',
        'gambar_e',
        'jawaban',
    ];
    function guru() {
        return $this->belongsTo(User::class,'guru_id','id');
    }
    function mapel() {
        return $this->belongsTo(Mapel::class);
    }
}
