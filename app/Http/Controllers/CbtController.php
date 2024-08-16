<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\HasilDetail;
use App\Models\Kelasguru;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CbtController extends Controller
{
    public function cbt()
    {
        // Mendapatkan ID guru yang mengajar kelas dengan ID 4 dari tabel gurukelas
        $siswa = Auth::user();
        $guruIDs = Kelasguru::where('kelas_id', $siswa->kelas_id)->pluck('guru_id')->toArray();

        // Mencari ujian yang terkait dengan guru-guru tersebut
        $data = Ujian::whereIn('guru_id', $guruIDs)->get();
        return view('cbt.cbt', [
            'data' => $data
        ]);
    }
    public function cbt_ikut(Request $request, $id)
    {
        $ujian = Ujian::find($id);
        if ($ujian->token == $request->token) {
            $soald = Soal::where('guru_id', $ujian->guru_id)
                ->where('mapel_id', $ujian->mapel_id)
                ->inRandomOrder()
                ->take($ujian->jumlah_soal)
                ->get();
            $hasil = Hasil::firstOrCreate([
                'ujian_id' => $id,
                'siswa_id' => Auth::user()->id,
            ], [
                'tanggal_mulai' => now(),
            ]);

            if ($hasil->wasRecentlyCreated) {
                foreach ($soald as $key => $value) {
                    HasilDetail::firstOrCreate([
                        'hasil_id' => $hasil->id,
                        'soal_id' => $value->id,
                    ]);
                }
            }

            return redirect()->route('cbt.masuk', ['id' => $id, 'soal' => 1]);
        } else {
            return redirect()->back()->with('error', 'Token salah!!');
        }
    }
    public function cbt_masuk($id, $no)
    {
        $hasil = Hasil::where('ujian_id', $id)->where('siswa_id', Auth::user()->id)->first();
        if ($hasil) {
            $soal = HasilDetail::where('hasil_id', $hasil->id)->skip($no - 1)->first();
            return view('cbt.masuk', [
                'data' => $hasil,
                'soal' => $soal,
                'no' => $no
            ]);
        } else {
            return redirect()->back()->with('error', 'Tidak Boleh Masuk!!');
        }
    }
    public function cbt_masuk_input(Request $request, $id, $no)
    {
        $hd = HasilDetail::find($id);

        if ($request->jawaban) {
            $hd->jawaban = $request->jawaban;

            if ($hd->soal->tipe == 1 || $hd->soal->jawaban == $request->jawaban) {
                $hd->nilai = $hd->soal->bobot;
            } else {
                $hd->nilai = 0;
            }

            if ($hd->status == 2 && $request->status == 1) {
                $hd->status = 1;
            } elseif ($hd->status == 1 && $request->status == 1) {
                $hd->status = 2;
            } elseif ($hd->status == 0) {
                $hd->status = $request->status ?? 2;
            }

            $hd->save();
        }

        if ($request->no) {
            $soal = $request->no;
        } elseif ($request->status == 1 && $no - 1 == $hd->hasil->hasil_detail->count()) {
            $soal = $no - 1;
        } else {
            $soal = $no;
        }

        if ($request->status == 3) {
            $h = Hasil::find($hd->hasil_id);
            $j_benar = 0;
            $bobot = 0;
            $nilai = 0;
            foreach ($h->hasil_detail as $key => $value) {
                $bobot += $value->soal->bobot;
                if ($value->soal->tipe == 1) {
                    if($value->jawaban){
                    $j_benar += 1;
                    $nilai += $value->soal->bobot;
                    }
                }else if($value->soal->jawaban == $value->jawaban){
                    $j_benar += 1;
                    $nilai += $value->soal->bobot;
                }
            }
            $h->jml_benar = $j_benar;
            $h->nilai = $nilai;
            $h->bobot_nilai = $bobot;
            $h->tanggal_selesai = now();
            $h->status = 1;
            //dd($h);
            $h->save();
            return redirect()->route('cbt.index')->with('success', 'Ujian Telah Diselesaikan!!');
        };

        return redirect()->route('cbt.masuk', ['id' => $hd->hasil->ujian_id, 'soal' => $soal]);
    }
    public function cbt_cetak($id){
        $data = Hasil::where('ujian_id', $id)->where('siswa_id', Auth::user()->id)->first();
        return view('cbt.cetak',[
            "data" => $data
        ]);
    }
    public function cbt_hasil(){
        $data = Ujian::get();
        return view('cbt.hasil',[
            "data" => $data
        ]);
    }
    public function cbt_hasil_cetak($id){
        $data = Hasil::where('ujian_id', $id)->get();
        return view('cbt.cetak_hasil',[
            "data" => $data
        ]);
    }
}
