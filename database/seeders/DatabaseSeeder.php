<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\mapel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Dummy Jurusan data
        $jurusan1 = Jurusan::create([
            'nama_jurusan' => 'Teknik Informatika'
        ]);

        $jurusan2 = Jurusan::create([
            'nama_jurusan' => 'Manajemen Bisnis'
        ]);

        $jurusan3 = Jurusan::create([
            'nama_jurusan' => 'Akuntansi'
        ]);

        // Dummy Kelas data
        $kelas1 = Kelas::create([
            'nama_kelas' => 'AX1001',
            'jurusan_id' => $jurusan1->id,
        ]);

        $kelas2 = Kelas::create([
            'nama_kelas' => 'MB2002',
            'jurusan_id' => $jurusan2->id,
        ]);

        $kelas3 = Kelas::create([
            'nama_kelas' => 'AK3003',
            'jurusan_id' => $jurusan3->id,
        ]);

        // Dummy mapel data
        $mapel1 = mapel::create([
            'nama_mapel' => 'Pemrograman Dasar'
        ]);

        $mapel2 = mapel::create([
            'nama_mapel' => 'Basis Data'
        ]);

        $mapel3 = mapel::create([
            'nama_mapel' => 'Algoritma dan Struktur Data'
        ]);

        $mapel4 = mapel::create([
            'nama_mapel' => 'Manajemen Keuangan'
        ]);

        $mapel5 = mapel::create([
            'nama_mapel' => 'Pemasaran'
        ]);

        $mapel6 = mapel::create([
            'nama_mapel' => 'Akuntansi Keuangan'
        ]);

        // Dummy Admin data
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'uid' => '0',
            'password' => Hash::make("password"),
            'jk' => 'Laki-laki',
            'role' => 0,
            'status' => 1
        ]);

        // Dummy guru data
        $guru1 = User::create([
            'name' => 'guru',
            'email' => 'guru@gmail.com',
            'uid' => '12321',
            'password' => Hash::make("password"),
            'role' => 1,
            'jk' => 'Laki-laki',
            'status' => 1,
            'mapel_id' => $mapel1->id
        ]);

        $guru2 = User::create([
            'name' => 'guru2',
            'email' => 'guru2@gmail.com',
            'uid' => '56789',
            'password' => Hash::make("password"),
            'role' => 1,
            'jk' => 'Perempuan',
            'status' => 1,
            'mapel_id' => $mapel4->id
        ]);

        // Dummy siswa data
        User::create([
            'name' => 'siswa',
            'email' => 'siswa@gmail.com',
            'uid' => '124124',
            'password' => Hash::make("password"),
            'jk' => 'Perempuan',
            'role' => 2,
            'status' => 1,
            'jurusan_id' => $jurusan1->id,
            'kelas_id' => $kelas1->id
        ]);

        User::create([
            'name' => 'siswa2',
            'email' => 'siswa2@gmail.com',
            'uid' => '567567',
            'password' => Hash::make("password"),
            'jk' => 'Laki-laki',
            'role' => 2,
            'status' => 1,
            'jurusan_id' => $jurusan2->id,
            'kelas_id' => $kelas2->id
        ]);

        User::create([
            'name' => 'siswa3',
            'email' => 'siswa3@gmail.com',
            'uid' => '989898',
            'password' => Hash::make("password"),
            'jk' => 'Perempuan',
            'role' => 2,
            'status' => 1,
            'jurusan_id' => $jurusan3->id,
            'kelas_id' => $kelas3->id
        ]);
        DB::table('soal')->insert([
            [
                'id' => 1,
                'guru_id' => 2,
                'mapel_id' => 1,
                'bobot' => 40,
                'gambar_soal' => 'img/gambar_soal/gambar_soal_1689178250.jpg',
                'soal' => 'dari gambar dibawah ini jelaskan cara kerjanya',
                'tipe' => 1,
                'opsi_a' => null,
                'opsi_b' => null,
                'opsi_c' => null,
                'opsi_d' => null,
                'opsi_e' => null,
                'gambar_a' => null,
                'gambar_b' => null,
                'gambar_c' => null,
                'gambar_d' => null,
                'gambar_e' => null,
                'jawaban' => null,
            ],
            [
                'id' => 2,
                'guru_id' => 2,
                'mapel_id' => 1,
                'bobot' => 10,
                'gambar_soal' => null,
                'soal' => '<p>1+1 =</p>',
                'tipe' => 0,
                'opsi_a' => '<p>2</p>',
                'opsi_b' => '<p>3</p>',
                'opsi_c' => '<p>4</p>',
                'opsi_d' => '<p>5</p>',
                'opsi_e' => '<p>6</p>',
                'gambar_a' => null,
                'gambar_b' => null,
                'gambar_c' => null,
                'gambar_d' => null,
                'gambar_e' => 'img/gambar_opsi/gambar_soal_1689178284.jpg',
                'jawaban' => 'a',
            ],
            [
                'id' => 3,
                'guru_id' => 2,
                'mapel_id' => 1,
                'bobot' => 10,
                'gambar_soal' => null,
                'soal' => '<p>kamu+dia =</p>',
                'tipe' => 0,
                'opsi_a' => '<p>kita</p>',
                'opsi_b' => '<p>mustahil</p>',
                'opsi_c' => '<p>haha</p>',
                'opsi_d' => '<p>5</p>',
                'opsi_e' => '<p>6</p>',
                'gambar_a' => null,
                'gambar_b' => null,
                'gambar_c' => null,
                'gambar_d' => null,
                'gambar_e' => null,
                'jawaban' => 'b',
            ],
        ]);
        DB::table('ujian')->insert([
            [
                'id' => 1,
                'guru_id' => 2,
                'mapel_id' => 1,
                'nama_ujian' => 'UTS',
                'jumlah_soal' => 2,
                'waktu' => 60,
                'jenis' => 0,
                'token' => 'O8JG7F',
                'tanggal_mulai' => '2023-07-12 23:11:00',
                'tanggal_selesai' => '2023-07-14 23:11:00',
            ],
        ]);
        DB::table('kelas_guru')->insert([
            [
                'id' => 1,
                'kelas_id' => 1,
                'guru_id' => 2,
            ],
        ]);
    }
}
