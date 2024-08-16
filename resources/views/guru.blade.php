@extends('layouts.layout')

@section('title', 'guru')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data guru</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah guru
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama guru</th>
                        <th>Email</th>
                        <th>Mata pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $guru)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $guru->uid }}</td>
                            <td>{{ $guru->name }}</td>
                            <td>{{ $guru->email }}</td>
                            <td>{{ $guru->mapel->nama_mapel }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $guru->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                @if ($guru->status == 0)
                                    <a href="{{ route('guru.status', $guru->id) }}" class="btn btn-sm btn-primary">
                                        Aktif
                                    </a>
                                @endif
                                <a href="{{ route('guru.destroy', $guru->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $guru->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalEditLabel{{ $guru->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $guru->id }}">Edit guru</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="editNama">NIP</label>
                                                <input type="text" class="form-control" id="editNip" name="uid"
                                                    value="{{ $guru->uid }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="editNama">Nama guru</label>
                                                <input type="text" class="form-control" id="editNama" name="name"
                                                    value="{{ $guru->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="editNama">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="email"
                                                    value="{{ $guru->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Mata pelajaran</label>
                                                <select name="mapel_id" class="form-control" id="" required>
                                                    <option value="{{ $guru->mapel->id }}" selected>
                                                        {{ $guru->mapel->nama_mapel }}</option>
                                                    @foreach ($mapel as $k => $v)
                                                        <option value="{{ $v->id }}">{{ $v->nama_mapel }}
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
                    <h5 class="modal-title" id="modalTambahLabel">Tambah guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tambahNama">Nip</label>
                            <input type="text" class="form-control" id="tambahNama" name="uid">
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Nama guru</label>
                            <input type="text" class="form-control" id="tambahNama" name="name">
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Email</label>
                            <input type="email" class="form-control" id="tambahNama" name="email">
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Mata pelajaran</label>
                            <select name="mapel_id" class="form-control" id="" required>
                                <option selected disabled>Pilih Matapelajaran</option>
                                @foreach ($mapel as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->nama_mapel }}</option>
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
