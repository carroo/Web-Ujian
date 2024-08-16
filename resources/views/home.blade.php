@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    @if (Auth::user()->role == 0)
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jurusan }}</h3>
                        <p>Jurusan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-lightbulb "></i>
                    </div>
                    <a href="{{ route('jurusan.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $mapel }}</h3>
                        <p>Mata pelajaran</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{ route('mapel.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $kelas }}</h3>
                        <p>Kelas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <a href="{{ route('kelas.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $guru }}</h3>
                        <p>guru</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <a href="{{ route('guru.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $siswa }}</h3>
                        <p>siswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="{{ route('siswa.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->role == 1)
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="box-title">Informasi Akun</h3>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%">
                            <tr>
                                <th>Nama</th>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>{{ Auth::user()->uid }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Mata pelajaran</th>
                                <td>{{ Auth::user()->mapel->nama_mapel }}</td>
                            </tr>
                            <tr>
                                <th>Daftar Kelas</th>
                                <td>
                                    @foreach (Auth::user()->kelasguru as $ke => $value)
                                        <span class="bg-success p-1 rounded">{{ $value->kelas->nama_kelas }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info"><h3>Pemberitahuan</h3></div>
                    <div class="card-body">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem in animi quibusdam nihil esse
                            ratione, nulla sint enim natus, aut mollitia quas veniam, tempore quia!</p>
                        <ul class="pl-4">
                            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, culpa.</li>
                            <li>Provident dolores doloribus, fugit aperiam alias tempora saepe non omnis.</li>
                            <li>Doloribus sed eum et repellat distinctio a repudiandae quia voluptates.</li>
                            <li>Adipisci hic rerum illum odit possimus voluptatibus ad aliquid consequatur.</li>
                            <li>Laudantium sapiente architecto excepturi beatae est minus, labore non libero.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    @elseif(Auth::user()->role == 2)
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="box-title">Informasi Akun</h3>
                </div>
                <div class="card-body">
                    <table style="width: 100%">
                        <tr>
                            <th>Nama</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>{{ Auth::user()->uid }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ Auth::user()->jk }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ Auth::user()->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ Auth::user()->kelas->nama_kelas }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info"><h3>Pemberitahuan</h3></div>
                <div class="card-body">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem in animi quibusdam nihil esse
                        ratione, nulla sint enim natus, aut mollitia quas veniam, tempore quia!</p>
                    <ul class="pl-4">
                        <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, culpa.</li>
                        <li>Provident dolores doloribus, fugit aperiam alias tempora saepe non omnis.</li>
                        <li>Doloribus sed eum et repellat distinctio a repudiandae quia voluptates.</li>
                        <li>Adipisci hic rerum illum odit possimus voluptatibus ad aliquid consequatur.</li>
                        <li>Laudantium sapiente architecto excepturi beatae est minus, labore non libero.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    @endif

@endsection
