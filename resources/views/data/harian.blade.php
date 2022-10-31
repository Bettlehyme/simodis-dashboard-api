@extends('navbar.dash')

@section('content')

    @php
    $jml_hr = cal_days_in_month(CAL_GREGORIAN, $harian['bulan'], 2021); //jumlah hari perbulan

    $saidi = $harian['saidi_harian'];
    $saifi = $harian['saifi_harian'];

    @endphp

    <div class="container">
        <div class="page-heading mt-4">
            <div class="text-center">
                <h2>Dashboard Kehandalan UP3 Pekanbaru Tahun 2021</h2>
                <h5>Monitoring Kinerja SAIDI SAIFI Harian UP3 Pekanbaru</h5>
            </div>
        </div>

        @if ($ulp_exists == true)
            <section class="basic-choices">
                <div class="col-12">
                    <div class="card mt-5">
                        {{-- <div class="btn btn-danger">Select Filter</div> --}}
                        <div class="card-body">
                            <form method="GET" action="{{ url('/main/realisasi') }}">
                                {{-- <h6>Filtering</h6> --}}
                                {{-- <p>Use <code>.choices</code> class for basic choices control.</p> --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <select class="form-select" name="ulp" required>
                                                <option disabled selected>Pilih ULP</option>
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
                                    <div class="col-md-2">
                                        <fieldset class="form-group">
                                            <select class="form-select" id="basicSelect" name="bulan" required>
                                                <option disabled="disabled" selected>Pilih Bulan
                                                </option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    @php
                                                        $month_num = $i;
                                                        $month_name = date('F', mktime(0, 0, 0, $month_num, 10));
                                                    @endphp
                                                    <option value="{{ $i }}">{{ $month_name }}</option>
                                                @endfor
                                            </select>
                                            @error('bulan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary" type="submit">Refresh</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4 class="card-title">Monitoring SAIDI Harian</h4> --}}
                            </div>
                            <div class="card-body">
                                <figure class="highcharts-figure">
                                    <div id="saidi"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4 class="card-title">Monitoring SAIFI Harian</h4> --}}
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
            {{-- highcharts End --}}

            <h3>Tabel Realisasi Harian SAIDI SAIFI</h3>
            <p class="text-subtitle text-muted">Detail data perhitungan <i>realisasi</i> untuk seluruh ULP dan UP3</p>

            <!-- Responsive tables start -->
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
                                            @for ($hari = 1; $hari <= $jml_hr; $hari++)
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
                                        @foreach ($saidi['ulp'] as $row)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td class="text-bold-700">{{ $row['nama_ulp']->nama_ulp }}</td>
                                                @foreach ($row['data'] as $data)
                                                    @if ($data == 0)
                                                        <td class="table-warning">{{ $data }}</td>
                                                    @else
                                                        <td class="table-success">{{ $data }}</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-dark">
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $saidi['up3']['nama_up3'][0]->nama_ulp }}</td>
                                            @foreach ($saidi['up3']['data'] as $data)
                                                <td>{{ $data }}</td>
                                            @endforeach
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- Responsive tables start -->
            <section class="section">
                <div class="row" id="table-responsive">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">SAIFI HARIAN</h4>
                        </div>
                        <div class="card-body">
                            <!-- table responsive -->
                            <div class="table-responsive">
                                <table
                                    class="table mb-0 table-hover table-bordered table-wrapper-scroll-y my-custom-scrollbar"
                                    style="font-size: .5rem">
                                    <thead class="table-light header">
                                        <tr>

                                            <th>No</th>
                                            <th>Unit Layanan Pelanggan</th>
                                            @for ($hari = 1; $hari <= $jml_hr; $hari++)
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
                                        @foreach ($saifi['ulp'] as $row)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td style="font-weight: 500">{{ $row['nama_ulp']->nama_ulp }}</td>
                                                @foreach ($row['data'] as $data)
                                                    @if ($data == 0)
                                                        <td class="table-warning">{{ round($data, 2) }}</td>
                                                    @else
                                                        <td class="table-success">{{ round($data, 2) }}</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-dark">
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $saifi['up3']['nama_up3'][0]->nama_ulp }}</td>
                                            @foreach ($saifi['up3']['data'] as $data)
                                                <td>{{ $data }}</td>
                                            @endforeach
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- script js grafik realisasi SAIDI --}}
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
                        crosshair: true,
                        labels: {
                            step: 1,
                            style: {
                                fontSize: '8px'
                            }
                        }
                    }],
                    yAxis: [{ // Primary yAxis for line chart
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
                    }, { // Secondary yAxis for bar chart
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
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor ||
                            // theme
                            'rgba(255,255,255,0.25)'
                    },
                    series: [{
                        name: 'Realisasi Harian SAIDI',
                        type: 'column',
                        data: [
                            @for ($hari = 1; $hari <= $jml_hr; $hari++)
                                {{ $realisasi['harian_saidi'][$hari] }},
                            @endfor
                        ],
                        tooltip: {
                            valueSuffix: ' '
                        }
                    }, {
                        name: 'Realisasi Kumulatif SAIDI',
                        type: 'column',
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
                        yAxis: 1,
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
                        yAxis: 1,
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
                Highcharts.chart('saifi', { // script js grafik realisasi SAIFI 
                    chart: {
                        zoomType: 'xy'
                    },
                    title: {
                        text: 'Monitoring Realisasi SAIFI Harian'
                    },
                    subtitle: {
                        text: 'Source:  {{ $nama_ulp }}'
                    },
                    xAxis: [{
                        categories: [
                            @for ($hari = 1; $hari <= $jml_hr; $hari++)
                                {{ $hari }},
                            @endfor
                        ],
                        crosshair: true,
                        labels: {
                            step: 1,
                            style: {
                                fontSize: '8px'
                            }
                        }
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
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor ||
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
                        name: 'Realisasi Kumulatif SAIFI',
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
                        yAxis: 1,
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
        @else
            <section class="section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                        </div>
                    </div>
                </div>
            </section>
        @endif

    @endsection
