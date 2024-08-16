@extends('layouts.layout')

@section('title', 'siswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data siswa</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus    "></i>
                    Tambah siswa
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama siswa</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $siswa)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $siswa->uid }}</td>
                            <td>{{ $siswa->name }}</td>
                            <td>{{ $siswa->email }}</td>
                            <td>{{ $siswa->kelas->nama_kelas }}</td>
                            <td>{{ $siswa->jurusan->nama_jurusan }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $siswa->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                @if ($siswa->status == 0)
                                    <a href="{{ route('siswa.status', $siswa->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-check" aria-hidden="true"></i>
                                        Aktif
                                    </a>
                                @endif
                                <a href="{{ route('siswa.destroy', $siswa->id) }}"
                                    class="btn btn-sm btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $siswa->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalEditLabel{{ $siswa->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $siswa->id }}">Edit siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="editNama">NIM</label>
                                                <input type="text" class="form-control" id="editNIM" name="uid"
                                                    value="{{ $siswa->uid }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="editNama">Nama siswa</label>
                                                <input type="text" class="form-control" id="editNama" name="name"
                                                    value="{{ $siswa->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="editNama">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="email"
                                                    value="{{ $siswa->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jk">Jenis Kelamin</label>
                                                <select name="jk" class="form-control" id="jk" required>
                                                    <option selected disabled>Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki"
                                                        @if ($siswa->jk == 'Laki-laki') selected @endif>Laki-laki</option>
                                                    <option value="Perempuan"
                                                        @if ($siswa->jk == 'Perempuan') selected @endif>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">jurusan</label>
                                                <select name="jurusan_id" class="form-control jurusan-select"
                                                    id="jurusan_id" required>
                                                    <option value="{{ $siswa->jurusan->id }}" selected>
                                                        {{ $siswa->jurusan->nama_jurusan }}</option>
                                                    @foreach ($jurusan as $k => $v)
                                                        <option value="{{ $v->id }}">{{ $v->nama_jurusan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select name="kelas_id" class="form-control kelas-select" id="kelas_id"
                                                    required>
                                                    <option value="{{ $siswa->kelas->id }}" selected>
                                                        {{ $siswa->kelas->nama_kelas }}</option>
                                                    @foreach ($kelas as $k => $v)
                                                        <option value="{{ $v->id }}">{{ $v->nama_kelas }}
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
                    <h5 class="modal-title" id="modalTambahLabel">Tambah siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tambahNama">NIM</label>
                            <input type="text" class="form-control" id="tambahNama" name="uid">
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Nama siswa</label>
                            <input type="text" class="form-control" id="tambahNama" name="name">
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Email</label>
                            <input type="email" class="form-control" id="tambahNama" name="email">
                        </div>

                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" class="form-control" id="jk" required>
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan_id" class="form-control jurusan-select" id="jurusan_id" required>
                                <option selected disabled>Pilih Jurusan</option>
                                @foreach ($jurusan as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select name="kelas_id" class="form-control kelas-select" id="kelas_id" required>
                                <option selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->nama_kelas }}</option>
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
@section('scripts')
    <script>
        // Mendengarkan perubahan pada pilihan jurusan
        $('.jurusan-select').change(function() {
            var selectedJurusan = $(this).val();
            var kelasSelect = $(this).closest('.form-group').next().find('.kelas-select');

            // Menghapus semua opsi kelas sebelumnya
            kelasSelect.html('<option selected disabled>Pilih Kelas</option>');

            // Menampilkan hanya opsi kelas dengan jurusan_id yang sesuai
            @foreach ($kelas as $kelasItem)
                if ({{ $kelasItem->jurusan_id }} === parseInt(selectedJurusan)) {
                    var option = $('<option></option>').val({{ $kelasItem->id }}).text(
                        '{{ $kelasItem->nama_kelas }}');
                    kelasSelect.append(option);
                }
            @endforeach
        });

        // Memanggil perubahan awal saat halaman dimuat
        $('.jurusan-select').change();
    </script>
@endsection
