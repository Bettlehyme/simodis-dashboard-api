@extends('navbar.dash')

@section('content')

    @php

    $jml_hr = cal_days_in_month(CAL_GREGORIAN, $harian['bulan'], 2021); //jumlah hari perbulan
    @endphp

    @if ($ulp_exists == false)
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                    <!-- Bootstrap Select end -->
                </div>
            </section>
        </div>
    @else
        <div class="container">
            <div class="page-heading mt-4">
                <div class="text-center">
                    <h2>Dashboard Kehandalan UP3 Pekanbaru Tahun 2021</h2>
                    <h5>Monitoring Kinerja SAIDI SAIFI Harian UP3 Pekanbaru</h5>
                </div>
            </div>
            {{-- <a href="{{ url('/main/rank') }}" class="col-12 btn btn-outline-danger mt-3">Hapus Filter</a> --}}
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ url('/main/rank') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-1">
                                    <h6>Bulan</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" name="bulan" id="mySelect()" onchange="onSelect">
                                            <option value="" disabled="disabled" selected>Pilih</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-1">
                                    <h6>Hari</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" name="hari">
                                            <option value="" disabled="disabled" selected>Pilih</option>
                                            @for ($i = 1; $i <= $jml_hr; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-3">
                                    <h6>ULP</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" name="ulp">
                                            <option value="" disabled="disabled" selected>Pilih</option>
                                            @for ($i = 0; $i < count($ulp_list); $i++)
                                                <option value="{{ $ulp_list[$i]->nama_ulp }}">
                                                    {{ $ulp_list[$i]->nama_ulp }}
                                                </option>
                                            @endfor
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-2">
                                    <h6>Tipe Gangguan</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" name="tipe_gangguan">
                                            <option value="" disabled="disabled" selected>Pilih</option>
                                            @foreach ($tipe_ggn as $value)
                                                <option value="{{ $value->tipe_gangguan }}">
                                                    {{ $value->tipe_gangguan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-1">
                                    <h6>Kategori</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" name="kategori">
                                            <option disabled="disabled" selected>Pilih</option>
                                            @foreach ($kategori as $value)
                                                <option value="{{ $value->kategori }}">
                                                    {{ $value->kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-2">
                                    <h6>Rayon</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" name="rayon">
                                            <option disabled="disabled" selected>Pilih</option>
                                            @foreach ($rayon as $value)
                                                <option value="{{ $value->rayon }}">
                                                    {{ $value->rayon }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-2 mt-4">
                                    <button class="btn btn-primary" type="submit">Refresh</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="row" id="table-responsive">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">SAIDI HARIAN</h4>
                        </div>
                        <div class="card-body">
                            <!-- table responsive -->
                            <div class="table-responsive">

                                <table
                                    class="table mb-0 table-hover table-bordered table-wrapper-scroll-y my-custom-scrollbar"
                                    style="font-size: .55rem">
                                    <thead class="table-light header">
                                        <tr>

                                            <th>No</th>
                                            <th>Unit Layanan Pelanggan</th>
                                            @for ($hari = 1; $hari <= 12; $hari++)
                                                <th>{{ $hari }}</th>
                                            @endfor

                                            {{-- <th scope="col">#</th>
                                        <th scope="col">Heading 1</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 0;
                                        @endphp
                                        @foreach ($fgtm2 as $row)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td class="text-bold-700">{{ $row->ulp }}</td>
                                                @foreach ($fgtm2 as $data)
                                                        <td class="table-success">{{ $data->jml_gangguan }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr class="table-dark">
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $saidi['up3']['nama_up3'][0]->nama_ulp }}</td>
                                            @foreach ($saidi['up3']['data'] as $data)
                                                <td>{{ $data }}</td>
                                            @endforeach
                                        </tr>
                                    </tfoot> --}}
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            
        </div>


    @endif

@endsection
