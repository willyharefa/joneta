<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.6/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
        <link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.6/css/froala_style.min.css' rel='stylesheet' type='text/css' />
        <link rel="icon" type="image/x-icon" href="{{ asset('/icon/favicon.png') }}">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        @stack('style')
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">GO-KOST</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @auth('owner')
                        <li><a class="dropdown-item" href="{{ route('owner.show', Auth::user()->id) }}">Pengaturan</a></li>
                        @endauth
                        @auth('web')
                        <li><a class="dropdown-item" href="#!">Pengaturan</a></li>
                        @endauth
                        <li><a class="dropdown-item" href="{{ route('maintenance') }}">Aktifitas</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item btn" id="logout">Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            @auth('owner')
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('owner.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard Utama
                            </a>
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="{{ route('kosan.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kosan
                            </a>
                            <a class="nav-link" href="{{ route('kamar.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-people-roof"></i></div>
                                Kamar
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pemesanan
                            </a>
                            <div class="sb-sidenav-menu-heading">Data</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('report_room') }}">Kamar</a>
                                    <a class="nav-link" href="{{ route('report_payment') }}">Pembayaran</a>
                                </nav>
                            </div>
                            @endauth
                            @auth('web')
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('client.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard Utama
                            </a>
                            <a class="nav-link" href="{{ route('monthly') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pembayaran
                            </a>
                            @endauth
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small text-muted mb-2">Logged sebagai :</div>
                        {{ auth()->user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        
        <script src="{{ asset('/js/scripts.js') }}"></script>
        <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script src="{{ asset('/js/dashboard.js') }}"></script>
        @stack('script')
        <script>
            CKEDITOR.replace( 'content');
            $(document).ready(function () {
                $('#dataTables').DataTable();
            });

            const btnLogOut = document.querySelector('#logout');
            btnLogOut.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                title: 'Logout ?',
                text: 'Session login anda akan dihapus dari sistem kami.',
                imageUrl: '{{ asset("/img/meme.jpg") }}',
                icon: 'info',
                imageWidth: 300,
                imageHeight: 150,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
                }).then((logout) => {
                    if(logout.isConfirmed) {
                        Swal.fire({
                            title: 'Berhasil Logout',
                            text: 'Selamat anda berhasil logout.',
                            icon: 'success',
                        });
                        setInterval(() => {
                            location.href = "{{ route('login.logout') }}"
                        }, 1300);
                    };
                })
            })
        </script>
    </body>
</html>
