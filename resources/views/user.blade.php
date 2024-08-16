@extends('layouts.layout')

@section('title', 'User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data user</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Dibuat pada</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $user)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="pl-2 bg-secondary text-white">
                                    @if ($user->role == 0)
                                        Admin
                                    @elseif($user->role == 1)
                                        guru
                                    @else
                                        siswa
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                @if ($user->status == 0)
                                    <div class="pl-2 bg-danger text-white"> Belum Aktif</div>
                                @else
                                    <div class="pl-2 bg-success text-white"> Aktif</div>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $user->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                @if ($user->status == 0)
                                    <a href="{{ route('user.status', $user->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check" aria-hidden="true"></i>
                                        Aktif
                                    </a>
                                @endif
                                <a href="{{ route('user.destroy', $user->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalEditLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $user->id }}">Edit user</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="editNama">Nama user</label>
                                                <input type="text" class="form-control" id="editNama" name="name"
                                                    value="{{ $user->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="editNama">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Level</label>
                                                <select name="role" class="form-control" id="role" required>
                                                    <option selected disabled>Pilih Role</option>
                                                    <option value="0"
                                                        @if ($user->role == 0) selected @endif>Admin
                                                    </option>
                                                    <option value="1"
                                                        @if ($user->role == 1) selected @endif>guru
                                                    </option>
                                                    <option value="2"
                                                        @if ($user->role == 2) selected @endif>siswa
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" class="form-control" id="status" required>
                                                    <option selected disabled>Pilih Role</option>
                                                    <option value="0"
                                                        @if ($user->status == 0) selected @endif>Tidak Aktif
                                                    </option>
                                                    <option value="1"
                                                        @if ($user->status == 1) selected @endif>Aktif
                                                    </option>
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
@endsection
