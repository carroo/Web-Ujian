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

        .garis {
            border-top: 3px solid black;
            margin: 20px 0;
            padding-bottom: 20px
        }

        /* Gaya untuk thead */
        thead {
            background-color: rgb(0, 0, 148);
            color: white;
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
    <table>
        <tr>
            <td colspan="2"><h2>Data Peserta</h2></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: {{ Auth::user()->uid }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: {{ Auth::user()->name }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: {{ Auth::user()->kelas->nama_kelas }}</td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td>: {{ Auth::user()->kelas->jurusan->nama_jurusan }}</td>
        </tr>

        <tr>
            <td colspan="2"><h2>Data Ujian</h2></td>
        </tr>
        <tr>
            <td>Mata pelajaran</td>
            <td>: {{ $data->ujian->mapel->nama_mapel }}</td>
        </tr>
        <tr>
            <td>Nama Ujian</td>
            <td>: {{ $data->ujian->nama_ujian }}</td>
        </tr>
        <tr>
            <td>Jumlah soal</td>
            <td>: {{ $data->ujian->jumlah_soal }}</td>
        </tr>
        <tr>
            <td colspan="2"><h2>Hasil Ujian</h2></td>
        </tr>
        <tr>
            <td>Jumlah Benar</td>
            <td>: {{ $data->jml_benar }}</td>
        </tr>
        <tr>
            <td>Nilai</td>
            <td>: {{ $data->nilai }}</td>
        </tr>
    </table>
</body>

</html>
