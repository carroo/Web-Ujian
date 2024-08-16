<!DOCTYPE html>
<html>

<head>
    <title>Halaman Cetak</title>
    <style>
        /* Gaya untuk header */
        header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        /* Gaya untuk judul */
        header h1 {
            margin: 0;
            padding-top: 30px;
            padding-bottom: 30px
        }

        /* Gaya untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }
        .tbl th,
        .tbl td {
            text-align: center;
        }

        .garis {
            border-top: 3px solid black;
            margin: 20px 0;
            padding-bottom: 20px
        }

        /* Gaya untuk judul kolom pada thead */
        th {
            white-space: nowrap;
            /* Mencegah pemisahan teks pada kolom */
        }

        .total {
            float: right;
            width: 400px;
            height: 20px;
            background-color: rgb(0, 0, 148);
            color: white;
            text-align: center;
            margin-top: 20px;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-md-6 {
            float: left;
            width: 50%;
        }

        .col-md-12 {
            width: 100%;
        }
    </style>
    <script>
        window.onload = function() {
            window.print(); // Cetak halaman saat halaman dimuat
        };
    </script>
</head>

<body>
    <header>
        <h1>Hasil Ujian</h1>
    </header>
    <div class="garis"></div>
    <div class="row">
        <div class="col-md-6">
            <table style="width: 100%">
                <tr>
                    <td><b>Nama Ujian</b></td>
                    <td>: {{ $data[0]->ujian->nama_ujian }}</td>
                </tr>
                <tr>
                    <td><b>Jumlah Soal</b></td>
                    <td>: {{ $data[0]->ujian->jumlah_soal }}</td>
                </tr>
                <tr>
                    <td><b>Waktu</b></td>
                    <td>: {{ $data[0]->ujian->waktu }}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Mulai</b></td>
                    <td>: {{ $data[0]->ujian->tanggal_mulai }}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Selesai</b></td>
                    <td>: {{ $data[0]->ujian->tanggal_selesai }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table style="width: 100%">
                <tr>
                    <td><b>Mata pelajaran</b></td>
                    <td>: {{ $data[0]->ujian->mapel->nama_mapel }}</td>
                </tr>
                <tr>
                    <td><b>Guru</b></td>
                    <td>: {{ $data[0]->ujian->guru->name }}</td>
                </tr>
                <tr>
                    <td><b>Nilai Terendah</b></td>
                    <td>: {{ $data->min('nilai') }}</td>
                </tr>
                <tr>
                    <td><b>Nilai Tertinggi</b></td>
                    <td>: {{ $data->max('nilai') }}</td>
                </tr>
                <tr>
                    <td><b>Nilai Rata-rata</b></td>
                    <td>: {{ $data->average('nilai') }}</td>
                </tr>
            </table>
        </div>
    </div>


    <div class="garis"></div>
    <div class="row">
        <div class="col-md-12">
            <table class="tbl">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Jumlah Benar</th>
                    <th>Nilai</th>
                </tr>
                @foreach ($data as $ke => $va)
                    <tr>
                        <td>{{ $ke + 1 }}</td>
                        <td>{{ $va->siswa->name }}</td>
                        <td>{{ $va->siswa->kelas->nama_kelas }}</td>
                        <td>{{ $va->siswa->kelas->jurusan->nama_jurusan }}</td>
                        <td>{{ $va->jml_benar }}</td>
                        <td>{{ $va->nilai }}</td>
                    </tr>

                    <!-- Modal Edit -->
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
