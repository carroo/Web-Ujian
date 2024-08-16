<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoalController extends Controller
{

    public function soal()
    {
        if (Auth::user()->role == 1) {
            $guru = User::where('id', Auth::user()->id)->get();
        } else {
            $guru = User::where('role', 1)->get();
        }
        $data = soal::get();
        return view('soal', [
            'data' => $data,
            'guru' => $guru
        ]);
    }

    public function soal_store(Request $request)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'soal' => 'required',
            'tipe' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $soal = new Soal;
        $soal->guru_id = $request->input('guru_id');
        $d = User::find($request->input('guru_id'));
        $soal->mapel_id = $d->mapel_id;
        $soal->soal = $request->input('soal');
        $soal->tipe = $request->input('tipe');
        $soal->bobot = $request->input('bobot');

        // Menghandle input file jika tidak kosong
        if ($request->hasFile('gambar_soal')) {
            $gambarSoal = $request->file('gambar_soal');
            $gambarSoalExtension = $gambarSoal->getClientOriginalExtension();
            $gambarSoalPath = $gambarSoal->move('img/gambar_soal', 'gambar_soal_' . time() . '.' . $gambarSoalExtension);
            $soal->gambar_soal = $gambarSoalPath;
        }

        // Menghandle opsi pilihan ganda jika tipe soal adalah pilihan ganda
        if ($request->input('tipe') == 0) {
            $opsiA = $request->input('opsi_a');
            $opsiB = $request->input('opsi_b');
            $opsiC = $request->input('opsi_c');
            $opsiD = $request->input('opsi_d');
            $opsiE = $request->input('opsi_e');

            // Menghandle input file untuk setiap opsi jika tidak kosong
            if ($request->hasFile('gambar_a')) {
                $gambarA = $request->file('gambar_a');
                $gambarAExtension = $gambarA->getClientOriginalExtension();
                $gambarAPath = $gambarA->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarAExtension);
                $soal->gambar_a = $gambarAPath;
            }

            if ($request->hasFile('gambar_b')) {
                $gambarB = $request->file('gambar_b');
                $gambarBExtension = $gambarB->getClientOriginalExtension();
                $gambarBPath = $gambarB->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarBExtension);
                $soal->gambar_b = $gambarBPath;
            }

            if ($request->hasFile('gambar_c')) {
                $gambarC = $request->file('gambar_c');
                $gambarCExtension = $gambarC->getClientOriginalExtension();
                $gambarCPath = $gambarC->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarCExtension);
                $soal->gambar_c = $gambarCPath;
            }

            if ($request->hasFile('gambar_d')) {
                $gambarD = $request->file('gambar_d');
                $gambarDExtension = $gambarD->getClientOriginalExtension();
                $gambarDPath = $gambarD->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarDExtension);
                $soal->gambar_d = $gambarDPath;
            }

            if ($request->hasFile('gambar_e')) {
                $gambarE = $request->file('gambar_e');
                $gambarEExtension = $gambarE->getClientOriginalExtension();
                $gambarEPath = $gambarE->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarEExtension);
                $soal->gambar_e = $gambarEPath;
            }

            // Simpan opsi ke dalam atribut $soal sesuai kebutuhan
            $soal->opsi_a = $opsiA;
            $soal->opsi_b = $opsiB;
            $soal->opsi_c = $opsiC;
            $soal->opsi_d = $opsiD;
            $soal->opsi_e = $opsiE;
            $soal->jawaban = $request->jawaban;
        }

        $soal->save();

        return redirect()->back()->with('success', 'Soal berhasil disimpan.');
    }
    public function soal_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'soal' => 'required',
            'tipe' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $soal = Soal::findOrFail($id);
        $soal->guru_id = $request->input('guru_id');
        $d = User::find($request->input('guru_id'));
        $soal->mapel_id = $d->mapel_id;
        $soal->soal = $request->input('soal');
        $soal->tipe = $request->input('tipe');
        $soal->bobot = $request->input('bobot');

        // Menghandle input file jika tidak kosong
        if ($request->hasFile('gambar_soal')) {
            $gambarSoal = $request->file('gambar_soal');
            $gambarSoalExtension = $gambarSoal->getClientOriginalExtension();
            $gambarSoalPath = $gambarSoal->move('img/gambar_soal', 'gambar_soal_' . time() . '.' . $gambarSoalExtension);
            $soal->gambar_soal = $gambarSoalPath;
        }

        // Menghandle opsi pilihan ganda jika tipe soal adalah pilihan ganda
        if ($request->input('tipe') == 0) {
            $opsiA = $request->input('opsi_a');
            $opsiB = $request->input('opsi_b');
            $opsiC = $request->input('opsi_c');
            $opsiD = $request->input('opsi_d');
            $opsiE = $request->input('opsi_e');

            // Menghandle input file untuk setiap opsi jika tidak kosong
            if ($request->hasFile('gambar_a')) {
                $gambarA = $request->file('gambar_a');
                $gambarAExtension = $gambarA->getClientOriginalExtension();
                $gambarAPath = $gambarA->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarAExtension);
                $soal->gambar_a = $gambarAPath;
            }

            if ($request->hasFile('gambar_b')) {
                $gambarB = $request->file('gambar_b');
                $gambarBExtension = $gambarB->getClientOriginalExtension();
                $gambarBPath = $gambarB->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarBExtension);
                $soal->gambar_b = $gambarBPath;
            }

            if ($request->hasFile('gambar_c')) {
                $gambarC = $request->file('gambar_c');
                $gambarCExtension = $gambarC->getClientOriginalExtension();
                $gambarCPath = $gambarC->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarCExtension);
                $soal->gambar_c = $gambarCPath;
            }

            if ($request->hasFile('gambar_d')) {
                $gambarD = $request->file('gambar_d');
                $gambarDExtension = $gambarD->getClientOriginalExtension();
                $gambarDPath = $gambarD->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarDExtension);
                $soal->gambar_d = $gambarDPath;
            }

            if ($request->hasFile('gambar_e')) {
                $gambarE = $request->file('gambar_e');
                $gambarEExtension = $gambarE->getClientOriginalExtension();
                $gambarEPath = $gambarE->move('img/gambar_opsi', 'gambar_soal_' . time() . '.' . $gambarEExtension);
                $soal->gambar_e = $gambarEPath;
            }

            // Simpan opsi ke dalam atribut $soal sesuai kebutuhan
            $soal->opsi_a = $opsiA;
            $soal->opsi_b = $opsiB;
            $soal->opsi_c = $opsiC;
            $soal->opsi_d = $opsiD;
            $soal->opsi_e = $opsiE;
            $soal->jawaban = $request->jawaban;
        }else{
            $soal->opsi_a = NULL;
            $soal->opsi_b = NULL;
            $soal->opsi_c = NULL;
            $soal->opsi_d = NULL;
            $soal->opsi_e = NULL;
            $soal->gambar_a = NULL;
            $soal->gambar_b = NULL;
            $soal->gambar_c = NULL;
            $soal->gambar_d = NULL;
            $soal->gambar_e = NULL;
            $soal->jawaban = NULL;

        }

        $soal->save();

        return redirect()->back()->with('success', 'Soal berhasil diperbarui.');
    }

    public function soal_destroy($id)
    {
        $soal = soal::findOrFail($id);
        $soal->delete();

        return redirect()->route('soal.index')->with('success', 'soal berhasil dihapus.');
    }
}
