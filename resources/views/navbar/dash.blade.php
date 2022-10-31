<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.ico') }}">
    <title>Dashboard | SI MODIS</title>

    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <!-- highcharts JS -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbar">
                <a href="{{ url()->previous() }}"><i class="bi bi-chevron-left"></i></a>
                <a class="navbar-brand ms-4 text-gray-800" href="#" style="font-size: 2rem">SI
                    MODIS</a>

                <ul class="nav navbar-nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link " aria-current=" page" href="{{ url('/main/realisasi') }}">Realisasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/main/rank') }}">Rank</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    @auth
                        {{-- <li class="nav-item dropdown me-1">
                            <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Mail</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">No new mail</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Notifications</h6>
                                </li>
                                <li><a class="dropdown-item">No notification available</a></li>
                            </ul>
                        </li> --}}
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                        <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->status }}</p>
                                    </div>
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('assets/images/faces/1.jpg') }}">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Welcome, {{ auth()->user()->name }}!</h6>
                                </li>
                                {{-- <li>
                                    <a class="dropdown-item" href="{{ url('/user/profile') }}">
                                        <i class="icon-mid bi bi-person me-2"></i>
                                        My Profile
                                    </a>
                                </li> --}}
                                @if (auth()->user()->status == 'Administrator')
                                    <li><a class="dropdown-item" href="/dash"><i class="icon-mid bi bi-gear me-2"></i>
                                            Administrator</a></li>
                                @endif
                                {{-- <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
                                            Wallet</a></li> --}}
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form action="/auth/logout" method="POST">
                                        @csrf
                                        <button class="dropdown-item"><i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/auth/login') }}"><i
                                    class="icon-mid bi bi-box-arrow-in-down-right me-2"></i>
                                Login</a></a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <div id="main-content">

        @yield('content')

    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

    </script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
