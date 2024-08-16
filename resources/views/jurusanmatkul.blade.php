@extends('layouts.layout')


@section('title', 'Jurusan - Matkul')

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
            <h3 class="card-title">Data Jurusan -  Mata Kuliah</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah jurusan - matkul
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $jurusanmatkul)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $jurusanmatkul->nama_matkul }}</td>>
                            <td>
                                @foreach ($jurusanmatkul->jurusanmatkul as $ke => $value)
                                    <span class="bg-success p-1 rounded">{{ $value->jurusan->nama_jurusan }}</span>
                                @endforeach
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $jurusanmatkul->id }}">
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
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Mata Kuliah - Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('jurusanmatkul.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="matkul">Mata Kuliah</label>
                            <select name="matkul_id" class="form-control" required>
                                <option selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($matkul as $k => $v)
                                    <option value="{{ $v->id }}">
                                        {{ $v->nama_matkul }}
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
    @foreach ($data as $k => $jurusanmatkul)
        <div class="modal fade" id="modalEdit{{ $jurusanmatkul->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditLabel{{ $jurusanmatkul->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel{{ $jurusanmatkul->id }}">Edit jurusan Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Edit -->
                        <form action="{{ route('jurusanmatkul.update', $jurusanmatkul->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="matkul">Mata Kuliah</label>
                                <select name="matkul_id" class="form-control" required>
                                    <option value="{{ $jurusanmatkul->id }}" selected >{{ $jurusanmatkul->nama_matkul }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="select2{{ $jurusanmatkul->id }}">Pilih jurusan</label>
                                <select id="select2{{ $jurusanmatkul->id }}" name="jurusan_id[]" class="form-control select2" style="width: 100%"
                                    multiple="multiple">
                                    @foreach ($jurusan as $k => $v)
                                        <option value="{{ $v->id }}"
                                            {{ in_array($v->id, $jurusanmatkul->jurusanmatkul->pluck('jurusan_id')->toArray()) ? 'selected' : '' }}>
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
