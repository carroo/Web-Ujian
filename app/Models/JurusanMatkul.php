<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanMatkul extends Model
{
    use HasFactory;
    protected $table = 'jurusan_matkul';
    protected $fillable = [
        'matkul_id',
        'jurusan_id',
    ];
    function matkul() {
        return $this->belongsTo(Matkul::class);
    }
    function jurusan() {
        return $this->belongsTo(Jurusan::class);
    }
}
