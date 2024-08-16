<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Jurusanmapel;
use App\Models\Kelas;
use App\Models\Kelasguru;
use App\Models\mapel;
use App\Models\User;
use Illuminate\Http\Request;

class RelasiController extends Controller
{
    public function kelasguru()
    {
        $data = User::where('role', 1)->has('kelasguru')->get();
        $guru = User::where('role', 1)->doesntHave('kelasguru')->get();
        $kelas = Kelas::get();
        return view('kelasguru', [
            'data' => $data,
            'guru' => $guru,
            'kelas' => $kelas
        ]);
    }
    public function kelasguru_store(Request $request)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required|array',
        ]);

        $guru = $validatedData['guru_id'];
        $kelas = $validatedData['kelas_id'];

        foreach ($kelas as $kelasId) {
            Kelasguru::create([
                'guru_id' => $guru,
                'kelas_id' => $kelasId,
            ]);
        }

        return redirect()->route('kelasguru.index')->with('success', 'Kelas guru berhasil ditambahkan');
    }

    public function kelasguru_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required|array',
        ]);

        $guru = $validatedData['guru_id'];
        $kelas = $validatedData['kelas_id'];

        // Hapus data kelas guru sebelumnya
        Kelasguru::where('guru_id', $id)->delete();

        // Tambahkan data kelas guru yang baru
        foreach ($kelas as $kelasId) {
            Kelasguru::create([
                'guru_id' => $guru,
                'kelas_id' => $kelasId,
            ]);
        }

        return redirect()->route('kelasguru.index')->with('success', 'Kelas guru berhasil diperbarui');
    }
    public function jurusanmapel()
    {
        $data = mapel::has('jurusanmapel')->get();
        $mapel = mapel::doesntHave('jurusanmapel')->get();
        $jurusan = Jurusan::get();
        return view('jurusanmapel', [
            'data' => $data,
            'jurusan' => $jurusan,
            'mapel' => $mapel
        ]);
    }
    public function jurusanmapel_store(Request $request)
    {
        $validatedData = $request->validate([
            'mapel_id' => 'required',
            'jurusan_id' => 'required|array',
        ]);

        $mapel = $validatedData['mapel_id'];
        $jurusan = $validatedData['jurusan_id'];

        foreach ($jurusan as $jurusanId) {
            jurusanmapel::create([
                'mapel_id' => $mapel,
                'jurusan_id' => $jurusanId,
            ]);
        }

        return redirect()->route('jurusanmapel.index')->with('success', 'Jurusan Mata pelajaran berhasil ditambahkan');
    }

    public function jurusanmapel_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'mapel_id' => 'required',
            'jurusan_id' => 'required|array',
        ]);

        $mapel = $validatedData['mapel_id'];
        $jurusan = $validatedData['jurusan_id'];


        jurusanmapel::where('mapel_id', $id)->delete();

        foreach ($jurusan as $jurusanId) {
            jurusanmapel::create([
                'mapel_id' => $mapel,
                'jurusan_id' => $jurusanId,
            ]);
        }

        return redirect()->route('jurusanmapel.index')->with('success', 'Jurusan Mata pelajaran berhasil diperbarui');
    }
}
