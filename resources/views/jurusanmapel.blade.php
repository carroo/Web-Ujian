@extends('layouts.layout')


@section('title', 'Jurusan - mapel')

@section('content')
    <style>
        /* Menyesuaikan tampilan warna select2 */
        .select2-selection__choice {
            margin-top: 5px !important;
            padding-right: 5px !important;
            padding-left: 5px !important;
            background-color: transparent !important;
            border: none !important;
            border-radius: 4px !important;
            background-color: rgba(13, 52, 136, 0.9) !important;
        }

        .select2-selection__choice__remove {
            border: none !important;
            border-radius: 0 !important;
            padding: 0 2px !important;
        }

        .select2-selection__choice__remove:hover {
            background-color: transparent !important;
            color: #ef5454 !important;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Jurusan -  Mata pelajaran</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah jurusan - mapel
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata pelajaran</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $jurusanmapel)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $jurusanmapel->nama_mapel }}</td>>
                            <td>
                                @foreach ($jurusanmapel->jurusanmapel as $ke => $value)
                                    <span class="bg-success p-1 rounded">{{ $value->jurusan->nama_jurusan }}</span>
                                @endforeach
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $jurusanmapel->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Mata pelajaran - Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('jurusanmapel.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="mapel">Mata pelajaran</label>
                            <select name="mapel_id" class="form-control" required>
                                <option selected disabled>Pilih Mata pelajaran</option>
                                @foreach ($mapel as $k => $v)
                                    <option value="{{ $v->id }}">
                                        {{ $v->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select2">Pilih jurusan</label>
                            <select id="select2" class="form-control select2" style="width: 100%" name="jurusan_id[]"
                                multiple="multiple">
                                @foreach ($jurusan as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->nama_jurusan }}</option>
                                @endforeach
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
    @foreach ($data as $k => $jurusanmapel)
        <div class="modal fade" id="modalEdit{{ $jurusanmapel->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditLabel{{ $jurusanmapel->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel{{ $jurusanmapel->id }}">Edit jurusan Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Edit -->
                        <form action="{{ route('jurusanmapel.update', $jurusanmapel->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="mapel">Mata pelajaran</label>
                                <select name="mapel_id" class="form-control" required>
                                    <option value="{{ $jurusanmapel->id }}" selected >{{ $jurusanmapel->nama_mapel }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="select2{{ $jurusanmapel->id }}">Pilih jurusan</label>
                                <select id="select2{{ $jurusanmapel->id }}" name="jurusan_id[]" class="form-control select2" style="width: 100%"
                                    multiple="multiple">
                                    @foreach ($jurusan as $k => $v)
                                        <option value="{{ $v->id }}"
                                            {{ in_array($v->id, $jurusanmapel->jurusanmapel->pluck('jurusan_id')->toArray()) ? 'selected' : '' }}>
                                            {{ $v->nama_jurusan }}</option>
                                    @endforeach
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
