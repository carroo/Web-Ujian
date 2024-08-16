@extends('layouts.laycbt')

@section('title', $data->ujian->nama_ujian)

@section('content')

    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0">{{ $data->ujian->nama_ujian }}</h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-md-end">
                <li class="breadcrumb-item">{{ $data->ujian->mapel->nama_mapel }}</li>
                <li class="breadcrumb-item active">{{ Auth::user()->kelas->nama_kelas }}</li>
            </ol>
        </div>
    </div>

    <form id="ujian" action="{{ route('cbt.masuk-input', ['id' => $soal->id, 'soal' => $no + 1]) }}" method="POST">
        @csrf <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-warning">

                        <h4 class="card-title">Navigasi Soal</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($data->hasil_detail as $k => $v)
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <button type="submit" name="no" value="{{ $k + 1 }}"
                                            class="btn btn-lg @if ($v->status == 1) btn-warning @elseif($v->status == 2) btn-success @else btn-outline-secondary @endif">{{ $k + 1 }}</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header bg-info d-flex justify-content-between align-items-center">
                        <span class="bg-primary rounded-pill px-2">Soal #{{ $no }}</span>
                        <span class="bg-danger rounded-pill px-2" id="jam"></span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-2">
                                {!! $soal->soal->soal !!}
                            </div>
                            <div class="col-md-12">
                                @if ($soal->soal->gambar_soal)
                                    <img src="{{ asset($soal->soal->gambar_soal) }}" style="max-height: 300px"
                                        class="img-fluid" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @if ($soal->soal->tipe == 1)
                                <label for="editSoal"><b>Jawaban</b></label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="jawaban" rows="4">{{ $soal->jawaban }}</textarea>
                                </div>
                            @else
                                <label for="editSoal"><b>Jawaban</b></label>
                                <input type="hidden" name="jawaban" id="jawaban" value="{{ $soal->jawaban }}">
                                <div class="col-md-12 mt-2">
                                    <div class="card mb-2" id="jawaban-a">
                                        <div
                                            class="card-header @if ($soal->jawaban == 'a') @if ($soal->status == 1) bg-warning @else bg-success @endif @endif">
                                            Jawaban A
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                {!! $soal->soal->opsi_a !!}
                                            </p>
                                            @if ($soal->soal->gambar_a)
                                                <br>
                                                <img src="{{ asset($soal->soal->gambar_a) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card mb-2" id="jawaban-b">
                                        <div
                                            class="card-header @if ($soal->jawaban == 'b') @if ($soal->status == 1) bg-warning @else bg-success @endif @endif">
                                            Jawaban B
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                {!! $soal->soal->opsi_b !!}
                                            </p>
                                            @if ($soal->soal->gambar_b)
                                                <br>
                                                <img src="{{ asset($soal->soal->gambar_b) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card mb-2" id="jawaban-c">
                                        <div class="card-header @if ($soal->jawaban == 'c') @if($soal->status == 1) bg-warning @else bg-success @endif @endif">
                                            Jawaban C
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                {!! $soal->soal->opsi_c !!}
                                            </p>
                                            @if ($soal->soal->gambar_c)
                                                <br>
                                                <img src="{{ asset($soal->soal->gambar_c) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card mb-2" id="jawaban-d">
                                        <div class="card-header @if ($soal->jawaban == 'd') @if($soal->status == 1) bg-warning @else bg-success @endif @endif">
                                            Jawaban D
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                {!! $soal->soal->opsi_d !!}
                                            </p>
                                            @if ($soal->soal->gambar_d)
                                                <br>
                                                <img src="{{ asset($soal->soal->gambar_d) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card mb-2" id="jawaban-e">
                                        <div class="card-header @if ($soal->jawaban == 'e') @if($soal->status == 1) bg-warning @else bg-success @endif @endif">
                                            Jawaban E
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                {!! $soal->soal->opsi_e !!}
                                            </p>
                                            @if ($soal->soal->gambar_e)
                                                <br>
                                                <img src="{{ asset($soal->soal->gambar_e) }}" style="max-height: 300px"
                                                    class="img-fluid" alt="">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            @if ($no != 1)
                                <button type="submit" name="no" value="{{ $no - 1 }}"
                                    class="btn btn-info">Kembali </button>
                            @endif
                        </div>
                        <div>
                            <button type="submit" name="status" value="1"
                                class="btn @if ($soal->status == 1) btn-warning @else btn-outline-warning @endif">Ragu</button>
                        </div>
                        <div>
                            @if ($no != $data->hasil_detail->count())
                                <button type="submit" name="status" value="2"
                                    class="btn btn-success">Lanjut</button>
                            @else
                                <button type="submit" name="status" value="3" class="btn btn-danger"
                                    onclick="showConfirmation(event)">Selesai</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection

@section('scripts')
    <script>
        function showConfirmation(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menyelesaikan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formAction = document.querySelector('#ujian').action;
                    // Tambahkan parameter status=3 pada URL action form
                    var newFormAction = formAction + '?status=3';
                    // Atur URL action form yang sudah dimodifikasi
                    document.querySelector('#ujian').action = newFormAction;

                    // Submit form
                    document.querySelector('#ujian').submit();
                }
            });
        }
    </script>

    <script>
        function updateTime() {
            var currentTime = new Date();
            var startTime = new Date("<?php echo $data->tanggal_mulai; ?>"); // Menggunakan nilai waktu_mulai dari PHP
            var duration = {{ $data->ujian->waktu }}; // Menggunakan nilai durasi dari PHP

            var endTime = new Date(startTime.getTime() + (duration *
                60000)); // Menghitung waktu akhir berdasarkan waktu_mulai dan durasi dalam milidetik

            var remainingTime = new Date(endTime.getTime() - currentTime
                .getTime()); // Menghitung waktu tersisa dalam milidetik

            var hours = remainingTime.getUTCHours(); // Mendapatkan jam dari waktu tersisa
            var minutes = remainingTime.getUTCMinutes(); // Mendapatkan menit dari waktu tersisa
            var seconds = remainingTime.getUTCSeconds(); // Mendapatkan detik dari waktu tersisa

            var jam = document.getElementById("jam");

            jam.innerHTML = "Waktu tersisa = " + hours + ":" + minutes + ":" + seconds;

            if (remainingTime <= 0) {
                jam.innerHTML = "Waktu telah habis!";
                setTimeout(function() {
                    var formAction = document.querySelector('#ujian').action;
                    // Tambahkan parameter status=3 pada URL action form
                    var newFormAction = formAction + '?status=3';
                    // Atur URL action form yang sudah dimodifikasi
                    document.querySelector('#ujian').action = newFormAction;

                    // Submit form
                    document.querySelector('#ujian').submit();
                }, 2000); // Menunda pengiriman formulir selama 2 detik setelah waktu habis

                Swal.fire({
                    title: 'Waktu telah habis',
                    text: 'Formulir akan dikirim dalam 2 detik',
                    icon: 'warning',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                jam.innerHTML = "Waktu tersisa = " + hours + ":" + minutes + ":" + seconds;
                setTimeout(updateTime, 1000); // Menjalankan fungsi updateTime() setiap 1 detik
            } // Menjalankan fungsi updateTime() setiap 1 detik
        }

        updateTime(); // Memanggil fungsi updateTime() untuk pertama kali
    </script>


    <script>
        $(document).ready(function() {
            // Klik pada Jawaban A
            $("#jawaban-a").click(function() {
                // Menghapus kelas bg-success dari semua elemen card-header
                $(".card-header").removeClass("bg-success");
                // Menambahkan kelas bg-success pada card-header Jawaban A
                $("#jawaban-a .card-header").addClass("bg-success");
                // Mengubah nilai input hidden menjadi 'a'
                $("#jawaban").val("a");
            });

            // Klik pada Jawaban B
            $("#jawaban-b").click(function() {
                // Menghapus kelas bg-success dari semua elemen card-header
                $(".card-header").removeClass("bg-success");
                // Menambahkan kelas bg-success pada card-header Jawaban B
                $("#jawaban-b .card-header").addClass("bg-success");
                // Mengubah nilai input hidden menjadi 'b'
                $("#jawaban").val("b");
            });

            // Klik pada Jawaban C
            $("#jawaban-c").click(function() {
                // Menghapus kelas bg-success dari semua elemen card-header
                $(".card-header").removeClass("bg-success");
                // Menambahkan kelas bg-success pada card-header Jawaban C
                $("#jawaban-c .card-header").addClass("bg-success");
                // Mengubah nilai input hidden menjadi 'c'
                $("#jawaban").val("c");
            });

            // Klik pada Jawaban D
            $("#jawaban-d").click(function() {
                // Menghapus kelas bg-success dari semua elemen card-header
                $(".card-header").removeClass("bg-success");
                // Menambahkan kelas bg-success pada card-header Jawaban D
                $("#jawaban-d .card-header").addClass("bg-success");
                // Mengubah nilai input hidden menjadi 'd'
                $("#jawaban").val("d");
            });

            // Klik pada Jawaban E
            $("#jawaban-e").click(function() {
                // Menghapus kelas bg-success dari semua elemen card-header
                $(".card-header").removeClass("bg-success");
                // Menambahkan kelas bg-success pada card-header Jawaban E
                $("#jawaban-e .card-header").addClass("bg-success");
                // Mengubah nilai input hidden menjadi 'e'
                $("#jawaban").val("e");
            });
        });
    </script>
@endsection
