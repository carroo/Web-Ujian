<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $table = 'hasil';
    protected $fillable = [
        'ujian_id',
        'siswa_id',
        'jml_benar',
        'nilai',
        'bobot_nilai',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
    function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id', 'id');
    }
    function hasil_detail()
    {
        return $this->hasMany(HasilDetail::class);
    }
}
