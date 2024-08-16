@extends('layouts.layout')

@section('title', 'Ujian')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Ujian</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    Tambah ujian
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ujian</th>
                        <th>Mata pelajaran</th>
                        <th>Jumlah Soal</th>
                        <th>Waktu</th>
                        <th>Acak Soal</th>
                        <th>Token</th>
                        <th>Aksi</th>
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
                                {{ $ujian->tanggal_mulai . ' - ' . $ujian->tanggal_selesai }}
                                <br>
                                ({{ $ujian->waktu }})
                                menit
                            </td>
                            <td>{{ $ujian->jenis == '0' ? 'Acak' : 'terurut' }}</td>
                            <td>
                                <div class="bg-success p-2 rounded"> {{ $ujian->token }}</div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $ujian->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                <a href="{{ route('ujian.token', $ujian->id) }}" class="btn btn-sm btn-info"><i class="fas fa-circle" aria-hidden="true"></i> Refresh Token</a>
                                <a href="{{ route('ujian.destroy', $ujian->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah ujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('ujian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="guru">guru - Mata pelajaran</label>
                            <select name="guru_id" class="form-control" id="guru" required>
                                @foreach ($guru as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->name }} -
                                        {{ $v->mapel->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Nama ujian</label>
                            <input type="text" class="form-control" name="nama_ujian">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_soal">Jumlah Soal</label>
                            <input type="number" class="form-control" name="jumlah_soal" required
                                max="{{ Auth::user()->soal->count() }}">
                        </div>
                        <div class="form-group">
                            <label for="mulai">Tanggal Mulai</label>
                            <input type="datetime-local" class="form-control" name="tanggal_mulai">
                        </div>
                        <div class="form-group">
                            <label for="selesai">Tanggal Selesai</label>
                            <input type="datetime-local" class="form-control" name="tanggal_selesai">
                        </div>
                        <div class="form-group">
                            <label for="waktu">Waktu (menit)</label>
                            <input type="number" class="form-control" name="waktu">
                        </div>
                        <div class="form-group">
                            <label for="acak">Tipe Acak</label>
                            <select name="jenis" class="form-control" id="acak" required>
                                <option value="0" selected>Acak
                                </option>
                                <option value="1">Urut
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    @foreach ($data as $k => $ujian)
        <div class="modal fade" id="modalEdit{{ $ujian->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditLabel{{ $ujian->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel{{ $ujian->id }}">Edit ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Edit -->
                        <form action="{{ route('ujian.update', $ujian->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="editguru">guru - Mata pelajaran</label>
                                <select name="guru_id" class="form-control" id="editguru" required>
                                    @foreach ($guru as $k => $v)
                                        <option value="{{ $v->id }}"
                                            {{ $ujian->guru->id === $v->id ? 'selected' : '' }}>
                                            {{ $v->name }} - {{ $v->mapel->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tambahNama">Nama ujian</label>
                                <input type="text" class="form-control" value="{{ $ujian->nama_ujian }}"
                                    name="nama_ujian">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_soal">Jumlah Soal</label>
                                <input type="number" class="form-control" value="{{ $ujian->jumlah_soal }}"
                                    name="jumlah_soal" required max="{{ Auth::user()->soal->count() }}">
                            </div>
                            <div class="form-group">
                                <label for="mulai">Tanggal Mulai</label>
                                <input type="datetime-local" class="form-control" value="{{ $ujian->tanggal_mulai }}"
                                    name="tanggal_mulai">
                            </div>
                            <div class="form-group">
                                <label for="selesai">Tanggal Selesai</label>
                                <input type="datetime-local" class="form-control" value="{{ $ujian->tanggal_selesai }}"
                                    name="tanggal_selesai">
                            </div>
                            <div class="form-group">
                                <label for="waktu">Waktu (menit)</label>
                                <input type="number" class="form-control" value="{{ $ujian->waktu }}" name="waktu">
                            </div>
                            <div class="form-group">
                                <label for="acak">Tipe Acak</label>
                                <select name="jenis" class="form-control" id="acak" required>
                                    <option value="0" {{ $ujian->jenis == 0 ? 'selected' : '' }}>Acak
                                    </option>
                                    <option value="1" {{ $ujian->jenis == 1 ? 'selected' : '' }}>Urut
                                    </option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
        $(document).ready(function() {});
    </script>
@endsection
