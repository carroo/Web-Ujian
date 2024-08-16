@extends('layouts.layout')

@section('title', 'Bank Soal')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Bank Soal</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah soal
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>guru</th>
                        <th>Mata pelajaran</th>
                        <th>Soal</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $soal)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $soal->guru->name }}</td>
                            <td>{{ $soal->mapel->nama_mapel }}</td>
                            <td>{!! $soal->soal !!}</td>
                            <td>{{ $soal->created_at }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#modalEdit{{ $soal->id }}">
                                    <i class="fas fa-pen    "></i>
                                    Edit
                                </button>
                                <a href="{{ route('soal.destroy', $soal->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('soal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="guru">guru - Mata pelajaran</label>
                            <select name="guru_id" class="form-control" id="guru" required>
                                @foreach ($guru as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->name }} - {{ $v->mapel->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tambahNama">Soal</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="file" class="form-control" name="gambar_soal">
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control tta" name="soal" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipe">Tipe</label>
                            <select name="tipe" class="form-control" id="tipe" required>
                                <option value="0" selected>Pilihan Ganda</option>
                                <option value="1">Essai</option>
                            </select>
                        </div>
                        <div id="ganda">
                            <div class="form-group">
                                <label for="opsi_1">Opsi A</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="gambar_a">
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control tta" name="opsi_a" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opsi_1">Opsi B</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="gambar_b">
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control tta" name="opsi_b" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opsi_1">Opsi C</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="gambar_c">
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control tta" name="opsi_c" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opsi_1">Opsi D</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="gambar_d">
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control tta" name="opsi_d" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opsi_1">Opsi E</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="gambar_e">
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control tta" name="opsi_e" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jawaban">Jawaban</label>
                                <select name="jawaban" class="form-control" id="acak">
                                    <option disabled selected>Pilih opsi jawaban yang benar
                                    </option>
                                    <option value="a">A
                                    </option>
                                    <option value="b">B
                                    </option>
                                    <option value="c">C
                                    </option>
                                    <option value="d">D
                                    </option>
                                    <option value="e">E
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div id="essai" style="display: none">

                        </div>

                        <div class="form-group">
                            <label for="tipe">Bobot</label>
                            <input type="number" class="form-control" name="bobot" required id="">
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
    @foreach ($data as $k => $soal)
        <div class="modal fade" id="modalEdit{{ $soal->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditLabel{{ $soal->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel{{ $soal->id }}">Edit Soal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Edit -->
                        <form action="{{ route('soal.update', $soal->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="editguru">guru - Mata pelajaran</label>
                                <select name="guru_id" class="form-control" id="editguru" required>
                                    @foreach ($guru as $k => $v)
                                        <option value="{{ $v->id }}"
                                            {{ $soal->guru->id === $v->id ? 'selected' : '' }}>
                                            {{ $v->name }} - {{ $v->mapel->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editSoal">Soal</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="gambar_soal">
                                        @if ($soal->gambar_soal)
                                            <br>
                                            <img src="{{ asset($soal->gambar_soal) }}" class="img-fluid"
                                                style="max-height: 300px" alt="">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control tta" name="soal" rows="4">{{ $soal->soal }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editTipe">Tipe</label>
                                <select name="tipe" class="form-control editTipe" id="editTipe" required>
                                    <option value="0" {{ $soal->tipe === 0 ? 'selected' : '' }}>Pilihan Ganda
                                    </option>
                                    <option value="1" {{ $soal->tipe === 1 ? 'selected' : '' }}>Essai</option>
                                </select>
                            </div>
                            <div class="editGanda"
                                style="{{ $soal->tipe === 0 ? 'display: block;' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="editOpsiA">Opsi A</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="gambar_a">
                                            @if ($soal->gambar_a)
                                                <img src="{{ asset($soal->gambar_a) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control tta" name="opsi_a" rows="4">{{ $soal->opsi_a }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editOpsiB">Opsi B</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="gambar_b">
                                            @if ($soal->gambar_b)
                                                <img src="{{ asset($soal->gambar_b) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control tta" name="opsi_b" rows="4">{{ $soal->opsi_b }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editOpsiC">Opsi C</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="gambar_c">
                                            @if ($soal->gambar_c)
                                                <img src="{{ asset($soal->gambar_c) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control tta" name="opsi_c" rows="4">{{ $soal->opsi_c }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editOpsiD">Opsi D</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="gambar_d">
                                            @if ($soal->gambar_d)
                                                <img src="{{ asset($soal->gambar_d) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control tta" name="opsi_d" rows="4">{{ $soal->opsi_d }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editOpsiE">Opsi E</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="gambar_e">
                                            @if ($soal->gambar_e)
                                                <img src="{{ asset($soal->gambar_e) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control tta" name="opsi_e" rows="4">{{ $soal->opsi_e }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jawaban">Jawaban</label>
                                    <select name="jawaban" class="form-control" id="acak">
                                        <option disabled selected>Pilih opsi jawaban yang benar
                                        </option>
                                        <option value="a" {{ $soal->jawaban == 'a' ? 'selected' : '' }}>A
                                        </option>
                                        <option value="b" {{ $soal->jawaban == 'b' ? 'selected' : '' }}>B
                                        </option>
                                        <option value="c" {{ $soal->jawaban == 'c' ? 'selected' : '' }}>C
                                        </option>
                                        <option value="d" {{ $soal->jawaban == 'd' ? 'selected' : '' }}>D
                                        </option>
                                        <option value="e" {{ $soal->jawaban == 'e' ? 'selected' : '' }}>E
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="editEssai"
                                style="{{ $soal->tipe === 1 ? 'display: block;' : 'display: none;' }}">

                            </div>
                            <div class="form-group">
                                <label for="editBobot">Bobot</label>
                                <input type="number" class="form-control" name="bobot" required
                                    value="{{ $soal->bobot }}">
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
        $(document).ready(function() {
            $('#tipe').change(function() {
                var selectedValue = $(this).val();

                if (selectedValue === '0') {
                    $('#ganda').show();
                    $('#essai').hide();
                } else if (selectedValue === '1') {
                    $('#ganda').hide();
                    $('#essai').show();
                }
            });
            $('.editTipe').change(function() {
                var selectedValue = $(this).val();
                var gandaDiv = $(this).closest('.modal-body').find('.editGanda');
                var essaiDiv = $(this).closest('.modal-body').find('.editEssai');

                if (selectedValue === '0') {
                    gandaDiv.show();
                    essaiDiv.hide();
                } else if (selectedValue === '1') {
                    gandaDiv.hide();
                    essaiDiv.show();
                }
            });
        });
    </script>
@endsection
