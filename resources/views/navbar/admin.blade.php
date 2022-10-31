<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.ico') }}">
    <title>Admin | SI MODIS</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon"> --}}

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <!-- highcharts JS -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



</head>

<script>
    $('#sidebar-menu .menu a').on('click', function() {
        $('#sidebar-menu .menu').find('li.active').removeClass('active');
        $(this).parent('li').addClass('active');
    });

</script>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        {{-- <div class="logo">
                            <a href="#"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"
                                    srcset=""></a>
                        </div> --}}
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                            <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->status }}</p>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu" id="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active" id="sidebar-dash">
                            <a href="{{ url('/dash') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub" id="sidebar-data">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Data</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{ url('/detailEvent') }}">Detail Event</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{ url('/masterdata') }}">Master Data</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{ url('/ulp') }}">ULP</a>
                                </li>
                                {{-- <li class="submenu-item ">
                                    <a href="#">Pivot</a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="sidebar-item " id="sidebar-tabel">
                            <a href="/user/data" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item " id="sidebar-tabel">
                            <a href="{{ url('/dash/rank') }}" class='sidebar-link'>
                                <i class="bi bi-bar-chart-fill"></i>
                                <span>Grafik Gangguan</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-title">Other</li>
                        {{-- <li class="sidebar-item " id="sidebar-tabel">
                            <a class='sidebar-link' href="{{ url('/user/profile') }}">
                                <i class="bi bi-person"></i>
                                <span> My Profile</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-item " id="sidebar-tabel">
                            <a class='sidebar-link' href="{{ url('/main/realisasi') }}">
                                <i class="bi bi-card-heading"></i>
                                <span> Main Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item " id="sidebar-tabel">
                            <a href="/auth/logout" class='sidebar-link'>
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

    </script>
    <script>
        // Simple Datatable
        let table2 = document.querySelector('#table2');
        let dataTable = new simpleDatatables.DataTable(table2);

    </script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
