@extends('layouts.layout')

@section('title', 'Mata Kuliah')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Mata Kuliah</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah matkul
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama matkul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $matkul)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $matkul->nama_matkul }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $matkul->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                <a href="{{ route('matkul.destroy', $matkul->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $matkul->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalEditLabel{{ $matkul->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $matkul->id }}">Edit matkul</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <form action="{{ route('matkul.update', $matkul->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="editNama">Nama matkul</label>
                                                <input type="text" class="form-control" id="editNama" name="nama"
                                                    value="{{ $matkul->nama_matkul }}">
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
                    <h5 class="modal-title" id="modalTambahLabel">Tambah matkul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('matkul.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tambahNama">Nama matkul</label>
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
