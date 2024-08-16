@extends('layouts.layout')

@section('title', 'Hasil Ujian')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Hasil Ujian</h3>
        </div>
        <div class="card-body">
            <table class="table bukan table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ujian</th>
                        <th>Mata pelajaran</th>
                        <th>Jumlah Soal</th>
                        <th>Waktu</th>
                        <th>Tanggal</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $ujian)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $ujian->nama_ujian }}</td>
                            <td>{{ $ujian->mapel->nama_mapel }}</td>
                            <td>{{ $ujian->jumlah_soal }}</td>
                            <td>
                                ({{ $ujian->waktu }})
                                menit
                            </td>
                            <td>{{ $ujian->tanggal_mulai }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalHasil{{ $ujian->id }}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Lihat Hasil
                                </button>
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
        <div class="modal fade" id="modalHasil{{ $ujian->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditLabel{{ $ujian->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel{{ $ujian->id }}">Hasil Ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table style="width: 100%">
                                    <tr>
                                        <td><b>Nama Ujian</b></td>
                                        <td>: {{ $ujian->nama_ujian }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Jumlah Soal</b></td>
                                        <td>: {{ $ujian->jumlah_soal }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Waktu</b></td>
                                        <td>: {{ $ujian->waktu }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Mulai</b></td>
                                        <td>: {{ $ujian->tanggal_mulai }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Selesai</b></td>
                                        <td>: {{ $ujian->tanggal_selesai }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table style="width: 100%">
                                    <tr>
                                        <td><b>Mata pelajaran</b></td>
                                        <td>: {{ $ujian->mapel->nama_mapel }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Guru</b></td>
                                        <td>: {{ $ujian->guru->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Nilai Terendah</b></td>
                                        <td>: {{ $ujian->hasil->min('nilai') }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Nilai Tertinggi</b></td>
                                        <td>: {{ $ujian->hasil->max('nilai') }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Nilai Rata-rata</b></td>
                                        <td>: {{ $ujian->hasil->average('nilai') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table bukan table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Jumlah Benar</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ujian->hasil as $ke => $va)
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{ route('cbt.hasil-cetak', $ujian->id) }}" target="__blank" class="btn btn-primary"><i
                                class="fa fa-print" aria-hidden="true"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
