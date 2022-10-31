@extends('navbar.admin')

@section('content')

    <!-- Input Style start -->
    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Data ULP</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/ulp/add') }}" class="was-validated">
                            @csrf
                            <div class="row needs-validation">
                                <div class="col-12">
                                    <p>Isi form sesuai dengan data yang ada</p>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="roundText">Nama ULP</label>
                                        <input type="text" id="roundText" name="nama_ulp" class="form-control round"
                                            placeholder="Masukkan nama ULP" required>
                                    </div>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                    <div class="form-group">
                                        <label for="roundText">Jumlah Pelanggan</label>
                                        <input type="text" id="roundText" name="jumlah_ulp" class="form-control round"
                                            placeholder="Masukkan jumlah pelanggan ULP" required>
                                    </div>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="roundText">Target SAIDI</label>
                                        <input type="text" id="roundText" name="target1_ulp" class="form-control round"
                                            placeholder="Masukkan jumlah pelanggan ULP" required>
                                    </div>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    <div class="form-group">
                                        <label for="roundText">Target SAIFI</label>
                                        <input type="text" id="roundText" name="target2_ulp" class="form-control round"
                                            placeholder="Masukkan jumlah pelanggan ULP" required>
                                    </div>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary mr-5">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>DataTable</h3>
                        <p class="text-subtitle text-muted">For user to check they list</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">DataULP</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Simple Datatable
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>id</th>
                                    <th>Nama ULP</th>
                                    <th>Jumlah Pelanggan</th>
                                    <th>Target SAIDI</th>
                                    <th>Target SAIFI</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($dataulp as $key => $value)
                                    <tr>
                                        <td scope="row">{{ $no++ }}</td>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->nama_ulp }}</td>
                                        <td>{{ $value->jumlah_ulp }}</td>
                                        <td>{{ $value->target1_ulp }}</td>
                                        <td>{{ $value->target2_ulp }}</td>
                                        <td>
                                            <a href="/ulp/edit/{{ $value->id }}" class="btn btn-warning">Edit</a>
                                            <a href="/ulp/delete/{{ $value->id }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete this row?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </section>
    <!-- Input Style end -->
@endsection
