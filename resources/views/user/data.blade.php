@extends('navbar.admin')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible show fade" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Users Data</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data user dari sistem SI MODIS</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    Tabel Data User
                </div>
                <div class="card-body">
                    <a href="{{ url('/user/add') }}" class="btn btn-primary mb-3 ms-2"><i class="bi bi-person-plus-fill"
                            style="padding-right: 10px"></i>Tambah User</a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $row)
                                <tr>
                                    <td scope="row">{{ $no++ }}</td>
                                    <td class="text-bold-500">{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->password }}</td>
                                    <td>
                                        @if ($row->status == 'Administrator')
                                            <div class="badges">
                                                <span class="badge bg-primary">{{ $row->status }}</span>

                                            </div>
                                        @endif
                                        @if ($row->status == 'Supervisor')
                                            <div class="badges">
                                                <span class="badge bg-info">{{ $row->status }}</span>

                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="#" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a> --}}
                                        <a href="/user/delete/{{ $row->id }}" class="btn btn-danger"
                                            onclick="return confirm('Are you sure to delete this row?')"><i
                                                class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endsection
