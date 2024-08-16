<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasDosen extends Model
{
    use HasFactory;
    protected $table = 'kelas_dosen';
    protected $fillable = [
        'kelas_id',
        'dosen_id',
    ];
    function kelas() {
        return $this->belongsTo(Kelas::class);
    }
    function dosen() {
        return $this->belongsTo(User::class);
    }
}
