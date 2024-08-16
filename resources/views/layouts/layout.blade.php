<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - My Laravel App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i>
                        <span class="ml-1">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('profile.index') }}" class="dropdown-item">Profile</a>
                        <div class="dropdown-divider"></div>

                        <a href="" class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Ujian</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image mt-2">
                                <img class="img-circle elevation-2" alt="User Image" src="{{ asset('img/user.png') }}">
                            </div>
                            <div class="info">
                                <a href="#" class="d-block">
                                    <span>{{ Auth::user()->name }}</span><br>
                                    <span>{{ Auth::user()->uid }}</span>
                                </a>
                            </div>
                        </div>

                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        @if (Auth::user()->role == 0)
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ request()->is('master/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('jurusan.index') }}"
                                            class="nav-link {{ request()->routeIs('jurusan.index') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Jurusan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kelas.index') }}"
                                            class="nav-link {{ request()->routeIs('kelas.index') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kelas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('mapel.index') }}"
                                            class="nav-link {{ request()->routeIs('mapel.index') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Matapelajaran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('guru.index') }}"
                                            class="nav-link {{ request()->routeIs('guru.index') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Guru</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('siswa.index') }}"
                                            class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>siswa</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ request()->is('relasi/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-link"></i>
                                    <p>
                                        Relasi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('kelasguru.index') }}"
                                            class="nav-link {{ request()->routeIs('kelasguru.index') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Guru - Kelas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('jurusanmapel.index') }}"
                                            class="nav-link {{ request()->routeIs('jurusanmapel.index') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Jurusan - Mata pelajaran</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        User Management
                                    </p>
                                </a>
                            </li>
                        @elseif(Auth::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('soal.index') }}"
                                    class="nav-link {{ request()->routeIs('soal.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Bank Soal
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('ujian.index') }}"
                                    class="nav-link {{ request()->routeIs('ujian.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-pen"></i>
                                    <p>
                                        Ujian
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cbt.hasil') }}"
                                    class="nav-link {{ request()->routeIs('cbt.hasil') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Hasil Ujian
                                    </p>
                                </a>
                            </li>
                        @elseif(Auth::user()->role == 2)
                            <li class="nav-item">
                                <a href="{{ route('cbt.index') }}"
                                    class="nav-link {{ request()->routeIs('cbt.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-pen"></i>
                                    <p>
                                        Ujian
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <br>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-1">@yield('title')</h1>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Powered by Laravel &amp; AdminLTE
            </div>
            <strong>My Laravel App &copy; {{ date('Y') }}</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <script src="https://unpkg.com/@popperjs/core@2.11.2/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').not('.bukan').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },

                ],
            });

            $('.bukan').DataTable();
        });
    </script>
    <script>
        @if (Session::has('success'))
            Swal.fire('Sukses', '{{ Session::get('success') }}', 'success');
        @elseif (Session::has('error'))
            Swal.fire('Error', '{{ Session::get('error') }}', 'error');
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('.tta').summernote();
            $('.select2').select2();
        });
    </script>
    @yield('scripts')
</body>

</html>
