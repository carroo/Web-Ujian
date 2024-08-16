@extends('layouts.layout')

@section('title', 'Dosen')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data dosen</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah dosen
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama dosen</th>
                        <th>Email</th>
                        <th>Mata kuliah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $dosen)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $dosen->uid }}</td>
                            <td>{{ $dosen->name }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>{{ $dosen->matkul->nama_matkul }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $dosen->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                @if ($dosen->status == 0)
                                    <a href="{{ route('dosen.status', $dosen->id) }}" class="btn btn-sm btn-primary">
                                        Aktif
                                    </a>
                                @endif
                                <a href="{{ route('dosen.destroy', $dosen->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $dosen->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalEditLabel{{ $dosen->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $dosen->id }}">Edit dosen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="editNama">NIP</label>
                                                <input type="text" class="form-control" id="editNip" name="uid"
                                                    value="{{ $dosen->uid }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="editNama">Nama dosen</label>
                                                <input type="text" class="form-control" id="editNama" name="name"
                                                    value="{{ $dosen->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="editNama">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="email"
                                                    value="{{ $dosen->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Mata kuliah</label>
                                                <select name="matkul_id" class="form-control" id="" required>
                                                    <option value="{{ $dosen->matkul->id }}" selected>
                                                        {{ $dosen->matkul->nama_matkul }}</option>
                                                    @foreach ($matkul as $k => $v)
                                                        <option value="{{ $v->id }}">{{ $v->nama_matkul }}
                                                        </option>
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
                    <h5 class="modal-title" id="modalTambahLabel">Tambah dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('dosen.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tambahNama">Nip</label>
                            <input type="text" class="form-control" id="tambahNama" name="uid">
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Nama dosen</label>
                            <input type="text" class="form-control" id="tambahNama" name="name">
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Email</label>
                            <input type="email" class="form-control" id="tambahNama" name="email">
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Mata kuliah</label>
                            <select name="matkul_id" class="form-control" id="" required>
                                <option selected disabled>Pilih Matakuliah</option>
                                @foreach ($matkul as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->nama_matkul }}</option>
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
