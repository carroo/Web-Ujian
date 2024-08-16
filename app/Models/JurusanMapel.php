<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanMapel extends Model
{
    use HasFactory;
    protected $table = 'jurusan_mapel';
    protected $fillable = [
        'mapel_id',
        'jurusan_id',
    ];
    function mapel() {
        return $this->belongsTo(mapel::class);
    }
    function jurusan() {
        return $this->belongsTo(Jurusan::class);
    }
}
