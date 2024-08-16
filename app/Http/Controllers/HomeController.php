<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->status == 0) {
            return view("aktivasi");
        }
        return view('home', [
            "jurusan" => Jurusan::count(),
            "kelas" => Kelas::count(),
            "guru" => User::where('role', 1)->count(),
            "siswa" => User::where('role', 2)->count(),
            "mapel" => mapel::count(),
        ]);
    }
    public function jurusan()
    {
        $data = Jurusan::get();
        return view('jurusan', [
            'data' => $data
        ]);
    }
    public function jurusan_store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function jurusan_update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->nama_jurusan = $request->nama;
        $jurusan->save();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }
    public function jurusan_destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }

    public function kelas()
    {
        $data = kelas::get();
        $jurusan = Jurusan::get();
        return view('kelas', [
            'data' => $data,
            'jurusan' => $jurusan
        ]);
    }
    public function kelas_store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan_id' => 'required'
        ]);

        kelas::create([
            'nama_kelas' => $request->nama,
            'jurusan_id' => $request->jurusan_id
        ]);

        return redirect()->route('kelas.index')->with('success', 'kelas berhasil ditambahkan.');
    }

    public function kelas_update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan_id' => 'required'
        ]);

        $kelas = kelas::findOrFail($id);
        $kelas->nama_kelas = $request->nama;
        $kelas->jurusan_id = $request->jurusan_id;
        $kelas->save();

        return redirect()->route('kelas.index')->with('success', 'kelas berhasil diperbarui.');
    }
    public function kelas_destroy($id)
    {
        $kelas = kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'kelas berhasil dihapus.');
    }

    public function mapel()
    {
        $data = mapel::get();
        return view('mapel', [
            'data' => $data
        ]);
    }
    public function mapel_store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        mapel::create([
            'nama_mapel' => $request->nama
        ]);

        return redirect()->route('mapel.index')->with('success', 'mapel berhasil ditambahkan.');
    }

    public function mapel_update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $mapel = mapel::findOrFail($id);
        $mapel->nama_mapel = $request->nama;
        $mapel->save();

        return redirect()->route('mapel.index')->with('success', 'mapel berhasil diperbarui.');
    }
    public function mapel_destroy($id)
    {
        $mapel = mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'mapel berhasil dihapus.');
    }

    public function guru()
    {
        $data = User::where('role', 1)->get();
        $mapel = mapel::get();
        return view('guru', [
            'data' => $data,
            'mapel' => $mapel
        ]);
    }
    public function guru_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'uid' => 'required|unique:users,uid',
            'mapel_id' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'uid' => $request->uid,
            'password' => Hash::make($request->uid),
            'role' => 1,
            'status' => 0,
            'mapel_id' => $request->mapel_id
        ]);

        return redirect()->route('guru.index')->with('success', 'guru berhasil ditambahkan.');
    }

    public function guru_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'uid' => 'required',
            'mapel_id' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('guru.index')->with('success', 'guru berhasil diperbarui.');
    }
    public function guru_destroy($id)
    {
        $guru = user::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'guru berhasil dihapus.');
    }
    public function guru_status($id)
    {
        $guru = user::findOrFail($id);
        $guru->status = 1;
        $guru->save();

        return redirect()->route('guru.index')->with('success', 'guru berhasil diaktifkan.');
    }
    public function siswa()
    {
        $data = User::where('role', 2)->get();
        $jurusan = Jurusan::get();
        $kelas = Kelas::get();
        return view('siswa', [
            'data' => $data,
            'jurusan' => $jurusan,
            'kelas' => $kelas
        ]);
    }
    public function siswa_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'jk' => 'required',
            'uid' => 'required|unique:users,uid',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'uid' => $request->uid,
            'password' => Hash::make($request->uid),
            'jk' => $request->jk,
            'role' => 2,
            'status' => 0,
            'jurusan_id' => $request->jurusan_id,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'siswa berhasil ditambahkan.');
    }

    public function siswa_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'uid' => 'required',
            'jk' => 'required',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'siswa berhasil diperbarui.');
    }
    public function siswa_destroy($id)
    {
        $siswa = user::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'siswa berhasil dihapus.');
    }
    public function siswa_status($id)
    {
        $siswa = user::findOrFail($id);
        $siswa->status = 1;
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'siswa berhasil diaktifkan.');
    }
    public function user()
    {
        $data = User::get();
        return view('user', [
            'data' => $data,
        ]);
    }

    public function user_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'status' => 'required',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'user berhasil diperbarui.');
    }
    public function user_destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'user berhasil dihapus.');
    }
    public function profile()
    {
        $user = Auth::user();
        return view("profile", ["user" => $user]);
    }
    public function profile_update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'jk' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->jk = $request->jk;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
