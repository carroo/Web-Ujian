<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDetail extends Model
{
    use HasFactory;
    protected $table = 'hasil_detail';
    protected $fillable = [
        'hasil_id',
        'soal_id',
        'jawaban',
        'nilai',
        'status'
    ];
    function hasil() {
        return $this->belongsTo(Hasil::class);
    }
    function soal() {
        return $this->belongsTo(Soal::class);
    }
}
