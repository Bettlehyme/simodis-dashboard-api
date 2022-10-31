@extends('navbar.admin')

@section('content')

    @php
    // dd($harian);
    $jml_hr = cal_days_in_month(CAL_GREGORIAN, $harian['bulan'], 2021); //jumlah hari perbulan

    $saidi = $harian['saidi_harian'];
    $saifi = $harian['saifi_harian'];

    setlocale(LC_ALL, 'id_ID');

    @endphp

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

    @endif
@endsection
