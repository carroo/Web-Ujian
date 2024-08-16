<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function ujian()
    {
        if (Auth::user()->role == 1) {
            $guru = User::where('id', Auth::user()->id)->get();
        } else {
            $guru = User::where('role', 1)->get();
        }
        $data = ujian::get();
        return view('ujian', [
            'data' => $data,
            'guru' => $guru
        ]);
    }

    public function ujian_store(Request $request)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'nama_ujian' => 'required',
            'jumlah_soal' => 'required|numeric',
            'waktu' => 'required|numeric',
            'jenis' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        $ujian = new ujian;
        $ujian->guru_id = $request->input('guru_id');
        $d = User::find($request->input('guru_id'));
        $ujian->mapel_id = $d->mapel_id;
        $ujian->nama_ujian = $request->input('nama_ujian');
        $ujian->jumlah_soal = $request->input('jumlah_soal');
        $ujian->waktu = $request->input('waktu');
        $ujian->jenis = $request->input('jenis');
        $ujian->tanggal_mulai = $request->input('tanggal_mulai');
        $ujian->tanggal_selesai = $request->input('tanggal_selesai');
        $ujian->token = strtoupper(Str::random(6));
        $ujian->save();

        return redirect()->back()->with('success', 'ujian berhasil disimpan.');
    }
    public function ujian_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'nama_ujian' => 'required',
            'jumlah_soal' => 'required|numeric',
            'waktu' => 'required|numeric',
            'jenis' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        $ujian = ujian::findOrFail($id);
        $ujian->guru_id = $request->input('guru_id');
        $d = User::find($request->input('guru_id'));
        $ujian->mapel_id = $d->mapel_id;
        $ujian->nama_ujian = $request->input('nama_ujian');
        $ujian->jumlah_soal = $request->input('jumlah_soal');
        $ujian->waktu = $request->input('waktu');
        $ujian->jenis = $request->input('jenis');
        $ujian->tanggal_mulai = $request->input('tanggal_mulai');
        $ujian->tanggal_selesai = $request->input('tanggal_selesai');
        $ujian->token = strtoupper(Str::random(6));
        $ujian->save();
        return redirect()->back()->with('success', 'ujian berhasil diperbarui.');
    }
    public function ujian_token($id)
    {

        $ujian = ujian::findOrFail($id);
        $ujian->token = strtoupper(Str::random(6));
        $ujian->save();
        return redirect()->back()->with('success', 'Token ujian berhasil diperbarui.');
    }

    public function ujian_destroy($id)
    {
        $ujian = ujian::findOrFail($id);
        $ujian->delete();

        return redirect()->route('ujian.index')->with('success', 'ujian berhasil dihapus.');
    }
}
