<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.ico') }}">
    <title>SI MODIS - User Profile</title>

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
                {{-- <a class="navbar-brand ms-4 text-gray-800" href="#" style="font-size: 2rem">SI MODIS</a> --}}
            </div>
        </div>
    </nav>

    <div id="main-content">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title">Edit Profile User</h4>
                </div>
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-3 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="align-items-center">
                                            <div class="profile profile-xl">
                                                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="User Photo">
                                            </div>
                                            <div class="align-items-center">
                                                <h2 class="font-bold">John Duck</h2>
                                                <h4 class="badge bg-light-primary text-muted mb-0">@Administrator</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User Profile Data</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-content">
                                        <form class="form form-vertical" action="" method="">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="col-12">
                                                            <div class="form-group has-icon-left">
                                                                <label for="first-name-icon">Full Name</label>
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Input your full name"
                                                                        id="full-name">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-card-heading"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Username</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Input your username"
                                                                    id="first-name-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="password-id-icon">Password</label>
                                                            <div class="position-relative">
                                                                <input type="password" class="form-control"
                                                                    placeholder="Password" id="password-id-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="email-id-icon">Email</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Email" id="email-id-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-envelope"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="mobile-id-icon">Mobile</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Mobile"
                                                                    id="mobile-id-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-12">
                                                        <div class='form-check'>
                                                            <div class="checkbox mt-2">
                                                                <input type="checkbox" id="remember-me-v"
                                                                    class='form-check-input' checked>
                                                                <label for="remember-me-v">Remember Me</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit"
                                                            class="btn btn-primary me-1 mb-1">Save</button>
                                                        <button type="reset"
                                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-3">
                                        <div class="align-items-center">
                                            <h2 class="font-bold">John Duck</h2>
                                            <h4 class="badge bg-light-primary text-muted mb-0">@Administrator</h4>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                </section>
            </div>
        </div>
        {{-- <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title">Single Layout</h4>
                </div>
                
                <div class="card-body">
                    
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus nemo quasi labore expedita?
                        Veritatis
                        at maxime id voluptates excepturi molestiae possimus blanditiis dicta consequuntur maiores
                        suscipit,
                        eveniet neque obcaecati doloribus.</p>
                </div>
            </div>
        </div> --}}

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
