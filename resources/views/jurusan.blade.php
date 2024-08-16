@extends('layouts.layout')

@section('title', 'Jurusan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Jurusan</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah Jurusan
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $jurusan)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $jurusan->nama_jurusan }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $jurusan->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                <a href="{{ route('jurusan.destroy', $jurusan->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $jurusan->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalEditLabel{{ $jurusan->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $jurusan->id }}">Edit Jurusan</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="editNama">Nama Jurusan</label>
                                                <input type="text" class="form-control" id="editNama" name="nama"
                                                    value="{{ $jurusan->nama_jurusan }}">
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
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('jurusan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tambahNama">Nama Jurusan</label>
                            <input type="text" class="form-control" id="tambahNama" name="nama">
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
