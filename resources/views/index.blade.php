@extends('navbar.admin')

@section('content')

    @php
        // dd($harian);
        $jml_hr = cal_days_in_month(CAL_GREGORIAN, $harian['bulan'], 2021); //jumlah hari perbulan
        
        $saidi = $harian['saidi_harian'];
        $saifi = $harian['saifi_harian'];
        
        setlocale(LC_ALL, 'id_ID');
        
    @endphp
    <link rel="stylesheet" href="{{ asset('assets/css/flickity.min.css') }}">

    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

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
        <div class="page-content">

            <section class="row">
                <div class="col-12">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="viewcontainer">
                                        <div style="border-radius: 2em;">
                                            <div class="gallery js-flickity" data-flickity='{ "autoPlay": 2500 }'>
                                                @foreach ($images as $c)
                                                    <div class="gallery-cell" style="border-radius: 2em"><img id="imglogo"
                                                            src="{{ asset('assets/images/bg/' . $c->image . '') }}"
                                                            style="width:100%;" />
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="viewedit">

                                        </div>
                                        <div style="display: flex; flex-direction:row">
                                            <?php $s = 0; ?>
                                            @foreach ($images as $slide)
                                                <?php $s++; ?>
                                                <div class="viewimage">
                                                    <div class="containerview">
                                                        <img src="{{ asset('assets/images/bg/' . $slide->image . '') }}"
                                                            alt="{{ asset('assets/images/logo/logo-pln.png') }}" class="image" style="width:100%">
                                                        <div class="middle">
                                                            <a href="/dash/delphoto/{{ $slide->id }}"
                                                                style="color: red; font-size: 14px">Delete Photo</a>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary" id="btnkecil" style="width:100%"
                                                            type="button" data-bs-toggle="modal"
                                                            data-bs-target="#inlineForm<?php echo $s; ?>">
                                                            Change Photo
                                                        </button>


                                                        <!--login form Modal -->
                                                        <div class="modal fade text-left" id="inlineForm<?php echo $s; ?>"
                                                            tabindex="-1" aria-labelledby="myModalLabel<?php echo $s; ?>"
                                                            style="display: none; " aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                Change Photo
                                                                            </h4>
                                                                            <button type="button" class="close"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-x">
                                                                                    <line x1="18" y1="6"
                                                                                        x2="6" y2="18">
                                                                                    </line>
                                                                                    <line x1="6" y1="6"
                                                                                        x2="18" y2="18">
                                                                                    </line>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                        <form action="/dash/editphoto" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                        <div class="modal-body">
                                                                            <input class="form-control" type="file"
                                                                                id="formFile" name="file">

                                                                        </div>
                                                                        <input type="text" name="idgambar"
                                                                            value="{{ $slide->id }}" hidden />
                                                                        <div class="modal-footer">
                                                                        
                                                                            <button type="submit"
                                                                                class="btn btn-primary ml-1"
                                                                                >
                                                                                <i
                                                                                    class="bx bx-check d-block d-sm-none"></i>
                                                                                <span
                                                                                    class="d-none d-sm-block">Change</span>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0px">
                                            <button class="btn btn-primary" style="" type="button"
                                                data-bs-toggle="modal" data-bs-target="#inlineForm99">
                                                Add Photo
                                            </button>


                                            <!--login form Modal -->
                                            <div class="modal fade text-left" id="inlineForm99" tabindex="-1"
                                                aria-labelledby="myModalLabel99" style="display: none;"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel99">
                                                                Add Photo
                                                            </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-x">
                                                                    <line x1="18" y1="6" x2="6"
                                                                        y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18"
                                                                        y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <form action="dash/addphoto" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input class="form-control" type="file" id="file"
                                                                    name="file" />

                                                            </div>
                                                            <div class="modal-footer">

                                                                <button type="submit" class="btn btn-primary ml-1">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Add</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/dash') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h6>Select Bulan</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="bulan" required>
                                                    <option disabled="disabled" selected>Pilih</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        @php
                                                            $month_num = $i;
                                                            $month_name = date('F', mktime(0, 0, 0, $month_num, 10));
                                                        @endphp
                                                        <option value="{{ $i }}">{{ $month_name }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @error('bulan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Select Ulp</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="ulp" required>
                                                    <option disabled="disabled" selected>Pilih</option>
                                                    @for ($i = 0; $i < count($ulp_list); $i++)
                                                        <option value="{{ $ulp_list[$i]->nama_ulp }}">
                                                            {{ $ulp_list[$i]->nama_ulp }}
                                                        </option>
                                                    @endfor
                                                    <option value="{{ $up3_name[0]->nama_ulp }}">
                                                        {{ $up3_name[0]->nama_ulp }}
                                                    </option>
                                                </select>
                                                @error('ulp')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <button class="btn btn-primary" type="submit">Refresh</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Bootstrap Select end -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4>Monitoring Realisasi SAIDI Harian</h4> --}}
                            </div>
                            <div class="card-body">
                                <figure class="highcharts-figure">
                                    <div id="saidi"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4>Monitoring Realisasi SAIFI Harian</h4> --}}
                            </div>
                            <div class="card-body">
                                <figure class="highcharts-figure">
                                    <div id="saifi"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            Highcharts.chart('saidi', {
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Monitoring Realisasi SAIDI Harian'
                },
                subtitle: {
                    text: 'Source: {{ $nama_ulp }}'
                },
                xAxis: [{
                    categories: [
                        @for ($hari = 1; $hari <= $jml_hr; $hari++)
                            {{ $hari }},
                        @endfor
                    ],
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: 'Realisasi',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Target',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 120,
                    verticalAlign: 'top',
                    y: 100,
                    floating: true,
                    backgroundColor: Highcharts.defaultOptions.legend
                        .backgroundColor ||
                        // theme
                        'rgba(255,255,255,0.25)'
                },
                series: [{
                    name: 'Realisasi Harian SAIDI',
                    type: 'column',
                    yAxis: 1,
                    data: [
                        @for ($hari = 1; $hari <= $jml_hr; $hari++)
                            {{ $realisasi['harian_saidi'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ' '
                    }

                }, {
                    name: 'Realisasi Kumulatif',
                    type: 'column',
                    yAxis: 1,
                    data: [
                        @for ($hari = 1; $hari <= $jml_hr; $hari++)
                            {{ $realisasi['relekum_saidi'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ' '
                    }

                }, {
                    name: 'Target Kumulatif',
                    type: 'spline',
                    data: [
                        @for ($hari = 1; $hari <= count($target['target_saidi']['target_kum']); $hari++)
                            {{ $target['target_saidi']['target_kum'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ''
                    }
                }, {
                    name: 'Target Harian',
                    type: 'spline',
                    data: [
                        @for ($hari = 1; $hari <= count($target['target_saidi']['target_harian']); $hari++)
                            {{ $target['target_saidi']['target_harian'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ''
                    }
                }]
            });
        </script>
        <script>
            Highcharts.chart('saifi', {
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Monitoring Realisasi SAIFI Harian'
                },
                subtitle: {
                    text: "Source: {{ $nama_ulp }}"
                },
                xAxis: [{
                    categories: [
                        @for ($hari = 1; $hari <= $jml_hr; $hari++)
                            {{ $hari }},
                        @endfor
                    ],
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: 'Realisasi',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Target',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 120,
                    verticalAlign: 'top',
                    y: 100,
                    floating: true,
                    backgroundColor: Highcharts.defaultOptions.legend
                        .backgroundColor ||
                        // theme
                        'rgba(255,255,255,0.25)'
                },
                series: [{
                    name: 'Realisasi Harian SAIFI',
                    type: 'column',
                    yAxis: 1,
                    data: [
                        @for ($hari = 1; $hari <= $jml_hr; $hari++)
                            {{ $realisasi['harian_saifi'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ' '
                    }

                }, {
                    name: 'Realisasi Kumulatif',
                    type: 'column',
                    yAxis: 1,
                    data: [
                        @for ($hari = 1; $hari <= $jml_hr; $hari++)
                            {{ $realisasi['relekum_saifi'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ' '
                    }

                }, {
                    name: 'Target Kumulatif',
                    type: 'spline',
                    data: [
                        @for ($hari = 1; $hari <= count($target['target_saifi']['target_kum']); $hari++)
                            {{ $target['target_saifi']['target_kum'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ''
                    }
                }, {
                    name: 'Target Harian',
                    type: 'spline',
                    data: [
                        @for ($hari = 1; $hari <= count($target['target_saifi']['target_harian']); $hari++)
                            {{ $target['target_saifi']['target_harian'][$hari] }},
                        @endfor
                    ],
                    tooltip: {
                        valueSuffix: ''
                    }
                }]
            });
        </script>
        <script src="{{ asset('assets/js/flickity.pkgd.min.js') }}"></script>
    @endif
@endsection
