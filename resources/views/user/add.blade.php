@extends('navbar.admin')

@section('content')

    <div id="main-content">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah User</h4>
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
                                                <h2 class="font-bold">
                                                    Your Name
                                                </h2>
                                                <h4 class="badge bg-light-primary text-muted mb-0">@yourstatus</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-content">
                                        <form class="form form-vertical" action="{{ url('/user/store') }}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Username</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Input your username" id="first-name-icon"
                                                                    name="username" autofocus>
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
                                                                    placeholder="Password" id="password-id-icon"
                                                                    name="password">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="email-id-icon">Email</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Email"
                                                                    id="email-id-icon" name="email">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-envelope"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label>Status</label>
                                                            <div class="input-group mb-3">
                                                                <label class="input-group-text"><i
                                                                        class="bi bi-exclamation-square"></i></label>
                                                                <select class="form-select" name="status">
                                                                    <option disabled selected>status...</option>\
                                                                    @foreach ($data as $value)
                                                                        <option value="{{ $value->status }}">
                                                                            {{ $value->status }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                            class="btn btn-primary me-1 mb-1">Tambah</button>
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

@endsection
