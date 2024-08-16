@extends('layouts.layout')

@section('title', 'kelas')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data kelas</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah kelas
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama kelas</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $kelas)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $kelas->nama_kelas }}</td>
                            <td>{{ $kelas->jurusan->nama_jurusan }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $kelas->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                <a href="{{ route('kelas.destroy', $kelas->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-train" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $kelas->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalEditLabel{{ $kelas->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $kelas->id }}">Edit kelas</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="editNama">Nama kelas</label>
                                                <input type="text" class="form-control" id="editNama" name="nama"
                                                    value="{{ $kelas->nama_kelas }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <select name="jurusan_id" class="form-control" id="" required>
                                                    <option value="{{ $kelas->jurusan->id }}" selected >{{ $kelas->jurusan->nama_jurusan }}</option>
                                                    @foreach ($jurusan as $k => $v)
                                                        <option value="{{ $v->id }}" >{{ $v->nama_jurusan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <h5 class="modal-title" id="modalTambahLabel">Tambah kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tambahNama">Nama kelas</label>
                            <input type="text" class="form-control" id="tambahNama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan_id" class="form-control" id="" required>
                                <option selected disabled>Pilih jurusan</option>
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
@endsection
