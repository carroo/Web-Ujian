<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasGuru extends Model
{
    use HasFactory;
    protected $table = 'kelas_guru';
    protected $fillable = [
        'kelas_id',
        'guru_id',
    ];
    function kelas() {
        return $this->belongsTo(Kelas::class);
    }
    function guru() {
        return $this->belongsTo(User::class);
    }
}
