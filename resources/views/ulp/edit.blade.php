@extends('navbar.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Edit</h3>
                    <p class="text-subtitle text-muted">Silahkan ubah form sesuai dengan data yang ada.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit ULP</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Horizontal form layout section start -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Data ULP</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST"
                                    action="{{ url('/ulp/update/' . $dataulp->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama ULP</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name" class="form-control" name="nama_ulp"
                                                    placeholder="" value="{{ $dataulp->nama_ulp }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah Pelanggan ULP</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="contact-info" class="form-control"
                                                    name="jumlah_ulp" placeholder="" value="{{ $dataulp->jumlah_ulp }}">
                                            </div>

                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <a href="{{ url('/ulp') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- // Basic Horizontal form layout section end -->
    @endsection
