@extends('layouts.layout')

@section('title', 'Ujian')

@section('content')
    <div class="row">


        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Kelas</h3>
                    <p>{{ Auth::user()->kelas->nama_kelas }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Jurusan</h3>
                    <p>{{ Auth::user()->jurusan->nama_jurusan }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-lightbulb "></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Tanggal</h3>
                    <p>{{ date('l, d F Y') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Jam</h3>
                    <p id="jam"></p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Ujian</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ujian</th>
                        <th>Mata pelajaran</th>
                        <th>Guru</th>
                        <th>Jumlah Soal</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $ujian)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $ujian->nama_ujian }}</td>
                            <td>{{ $ujian->mapel->nama_mapel }}</td>
                            <td>{{ $ujian->guru->name }}</td>
                            <td>{{ $ujian->jumlah_soal }}</td>
                            <td>
                                {{ $ujian->tanggal_mulai . ' - ' . $ujian->tanggal_selesai }}
                                <br>
                                ({{ $ujian->waktu }})
                                menit
                            </td>
                            <td>
                                @php
                                    $cek = $ujian->hasil->where('siswa_id', Auth::user()->id)->first();
                                @endphp
                                @isset($cek)
                                    @if ($cek->status == 0)
                                        <a href="{{ route('cbt.masuk', ['id' => $ujian->id, 'soal' => 1]) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            Lanjutkan
                                        </a>
                                    @else
                                        <a href="{{ route('cbt.cetak', $ujian->id) }}" target="__blank"
                                            class="btn btn-sm btn-info">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                            Cetak Hasil
                                        </a>
                                    @endif
                                @else
                                    @if ($ujian->tanggal_selesai >= now())
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#modalIkut{{ $ujian->id }}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            Ikut Ijian
                                        </button>
                                    @else
                                        <button disabled class=" btn btn-sm btn-danger">
                                            Terlambat
                                        </button>
                                    @endif
                                @endisset
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Edit -->
    @foreach ($data as $k => $ujian)
        <div class="modal fade" id="modalIkut{{ $ujian->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditLabel{{ $ujian->id }}" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaIkutLabel{{ $ujian->id }}">Ikut Ijian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="informasi">Informasi Ujian</label>
                        <table style="width: 100%">
                            <tr>
                                <td>Nama</td>
                                <td>: {{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <td>Guru</td>
                                <td>: {{ $ujian->guru->name }}</td>
                            </tr>
                            <tr>
                                <td>Kelas / Jurusan</td>
                                <td>:
                                    {{ Auth::user()->kelas->nama_kelas . '/' . Auth::user()->kelas->jurusan->nama_jurusan }}
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Ujian</td>
                                <td>: {{ $ujian->nama_ujian }}</td>
                            </tr>

                            <tr>
                                <td>Waktu</td>
                                <td>: {{ $ujian->waktu }}</td>
                            </tr>
                            <tr>
                                <td>Terlambat</td>
                                <td>: {{ $ujian->tanggal_selesai }}</td>
                            </tr>
                        </table>
                        <br>
                        <!-- Form Edit -->
                        <form action="{{ route('cbt.ikut', $ujian->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="token">Masukan Token</label>
                                <input type="text" class="form-control" name="token" required>
                            </div>
                            <div class="alert alert-warning">
                                <p>Waktu ujian akan dimulai sesaat menekan tombol mulai berwarna hijau</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Mulai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('scripts')

    <script>
        function updateTime() {
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();

            var jam = document.getElementById("jam");

            jam.innerHTML = hours + ":" + minutes + ":" + seconds;

            setTimeout(updateTime, 1000); // Menjalankan fungsi updateTime() setiap 1 detik
        }

        updateTime(); // Memanggil fungsi updateTime() untuk pertama kali
    </script>
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
