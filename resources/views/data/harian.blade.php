@extends('navbar.dash')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/flickity.min.css') }}">
    @php
        $jml_hr = cal_days_in_month(CAL_GREGORIAN, $harian['bulan'], 2021); //jumlah hari perbulan
        
        $saidi = $harian['saidi_harian'];
        $saifi = $harian['saifi_harian'];
        
    @endphp
    <div style="display: flex; flex-wrap: wrap; justify-content: center; border-radius:2em; overflow:hidden">
        <div class="main-top-page">
            <div class="imgcontainer" style="margin-top: 30px; margin-left:30px ">
                <img class="imglogo" src="{{ asset('assets/images/logo/logo-bumn.png') }}" />
                <img class="imglogo" src="{{ asset('assets/images/logo/logo-pln.png') }}" style="margin-top:2%; left:13%" />
            </div>
            <div class="gallery js-flickity" data-flickity='{ "autoPlay": 2500 }'>
                @foreach ($images as $c)
                    <div class="gallery-cell" style="border-radius: 2em"><img id="imglogo"
                            src="{{ asset('assets/images/bg/' . $c->image . '') }}" style="width:100%;" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">

        <div class="page-heading mt-4">
            <div class="text-center">
                <h2><img src="{{ asset('assets/images/logo/logo-simodis.png') }}" style="width: 20vh; height:5vh" /></h2>
                {{-- <h2>Dashboard Kehandalan UP3 Pekanbaru Tahun 2022</h2> --}}
                {{-- <h5>Monitoring Kinerja SAIDI SAIFI Harian UP3 Pekanbaru</h5> --}}
                <h5>Sistem Monitoring Distribusi</h5>
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
                                            <label>Pilih Ulp</label>
                                            <select class="form-select" name="ulp" required>
                                                <option selected hidden>

                                                    @php
                                                        if (isset($_GET['ulp'])) {
                                                            echo htmlspecialchars($_GET['ulp']);
                                                        } else {
                                                            echo 'UP3 PEKANBARU';
                                                        }
                                                    @endphp
                                                </option>
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
                                            <label> Pilih Bulan </label>
                                            <select class="form-select" id="basicSelect" name="bulan" required>
                                                @php
                                                    $month_num_selected = null;
                                                    if (isset($_GET['bulan'])) {
                                                        $month_num_selected = htmlspecialchars($_GET['bulan']);
                                                    } else {
                                                        $month_num_selected = 1;
                                                    }
                                                    $month_name_selected = date('F', mktime(0, 0, 0, $month_num_selected, 10));
                                                @endphp
                                                @php
                                                    if (isset($_GET['bulan'])) {
                                                        echo '<option value="' . htmlspecialchars($_GET['bulan']) . '" selected hidden>' . $month_name_selected . '</option>';
                                                    } else {
                                                        echo '<option value="1" selected hidden disable>January</option>';
                                                    }
                                                    
                                                @endphp

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
                                        <label style="margin-bottom: 6.2vh"></label>
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
                            {{-- <div class="card-header">
                                <h4 class="card-title">Monitoring SAIDI Bulanan</h4>
                            </div> --}}
                            <div class="card-body">
                                <div
                                    style="display:flex; width:100%; flex-wrap:nowrap; flex-direction:row; z-index:999999; position: relative;">
                                    <div class="gauge-container">
                                        <figure class="highcharts-figure">
                                            <div id="saidiBulgauge"></div>
                                        </figure>
                                    </div>
                                    <div class="gauge-container">
                                        <figure class="highcharts-figure">
                                            <div id="saidiKumgauge"></div>
                                        </figure>
                                    </div>
                                </div>
                                <figure class="highcharts-figure">
                                    <div id="saidi"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div style="display:flex; flex-direction:row; z-index:999999; position: relative;">
                                    <div class="gauge-container">
                                        <figure class="highcharts-figure">
                                            <div id="saifiBulgauge"></div>
                                        </figure>
                                    </div>
                                    <div class="gauge-container">
                                        <figure class="highcharts-figure">
                                            <div id="saifiKumgauge"></div>
                                        </figure>
                                    </div>
                                </div>

                                <figure class="highcharts-figure">
                                    <div id="saifi"></div>
                                </figure>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- ChartBar --}}

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
                            //theme
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
            {{-- Gauge Saidi --}}
            <script>
                Highcharts.chart('saidiBulgauge', {
                    {{ $saidiHarianValue = null }}
                    {{ $saidiTargetValue = null }}
                    {{ $saidiMaxValue = null }}
                    {{ $saidihariantarget = null }}
                    @for ($hari = 1; $hari <= $jml_hr; $hari++)
                        @php $saidiHarianValue += $realisasi['harian_saidi'][$hari] @endphp
                    @endfor
                    @foreach ($ulp_target1 as $target1_ulp)
                        @php $saidiTargetValue = ($target1_ulp->target1_ulp)/12 @endphp
                    @endforeach
                    @php
                        $saidihariantarget = $saidiHarianValue / $saidiTargetValue - 2;
                    @endphp
                    @php $saidiMaxValue = abs((abs($saidihariantarget)+0.02)-4.00)*100 @endphp


                    chart: {
                        type: 'gauge',
                        plotBackgroundColor: null,
                        plotBackgroundImage: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                        height: '50%',
                        zoomType: 'xy',
                    },

                    title: {
                        text: 'Bulanan Saidi'
                    },
                    credits: {
                        enabled: false
                    },
                    navigation: {
                        buttonOptions: {
                            enabled: false
                        }
                    },

                    pane: {
                        startAngle: -90,
                        endAngle: 89.9,
                        background: null,
                        center: ['50%', '75%'],
                        size: '110%'
                    },

                    // the value axis
                    yAxis: {
                        min: 0,
                        max: 200,
                        tickPixelInterval: 0,
                        tickPosition: 'inside',
                        tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                        tickLength: 25,
                        tickWidth: 2,
                        minorTickInterval: null,
                        labels: {
                            distance: 30,
                            style: {
                                fontSize: '14px'
                            }
                        },
                        plotBands: [{
                            from: 0,
                            to: 50,
                            color: '#DF5353', // red
                            thickness: 20
                        }, {
                            from: 50,
                            to: 100,
                            color: '#DDDF0D', // yellow
                            thickness: 20
                        }, {
                            from: 100,
                            to: 150,
                            color: '#55BF3B', // green
                            thickness: 20

                        }, {
                            from: 150,
                            to: 200,
                            color: '#4F77AA', // blue
                            thickness: 20

                        }]
                    },

                    series: [{
                        name: 'Bulanan Saidi',
                        data: [

                            @php echo round(abs(($saidiHarianValue/$saidiTargetValue)-2)*100,2)  @endphp
                        ],
                        tooltip: {
                            valueSuffix: ' %'
                        },
                        dataLabels: {
                            format: '{y} %',
                            borderWidth: 0,
                            color: (
                                Highcharts.defaultOptions.title &&
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || '#333333',
                            style: {
                                fontSize: '12px'
                            }
                        },
                        dial: {
                            radius: '80%',
                            backgroundColor: 'gray',
                            baseWidth: 12,
                            baseLength: '0%',
                            rearLength: '0%'
                        },
                        pivot: {
                            backgroundColor: 'gray',
                            radius: 6
                        }

                    }],


                });
            </script>
            <script>
                Highcharts.chart('saidiKumgauge', {
                    {{ $saidiKumulatifValue = null }}
                    {{ $saidiTargetKumulatifValue = null }}
                    {{ $saidiKumulatiMaxfValue = null }}
                    @for ($hari = 1; $hari <= $jml_hr; $hari++)
                        @php $saidiKumulatifValue += $realisasi['relekum_saidi'][$hari] @endphp
                    @endfor
                    @foreach ($ulp_target1 as $target2_ulp)
                        @php $saidiTargetKumulatifValue = $target2_ulp->target2_ulp @endphp
                    @endforeach

                    @php $saidiKumulatiMaxfValue = ((abs(abs($saidiKumulatifValue/$saidiTargetKumulatifValue)-2)+0.02)-4) @endphp
                    chart: {
                        type: 'gauge',
                        plotBackgroundColor: null,
                        plotBackgroundImage: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                        height: '50%'
                    },

                    title: {
                        text: 'Kumulatif Saidi'
                    },
                    credits: {
                        enabled: false
                    },
                    navigation: {
                        buttonOptions: {
                            enabled: false
                        }
                    },
                    pane: {
                        startAngle: -90,
                        endAngle: 89.9,
                        background: null,
                        center: ['50%', '75%'],
                        size: '110%'
                    },

                    // the value axis
                    yAxis: {
                        min: 0,
                        max: 200,
                        tickPixelInterval: 0,
                        tickPosition: 'inside',
                        tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                        tickLength: 20,
                        tickWidth: 2,
                        minorTickInterval: null,
                        labels: {
                            distance: 30,
                            style: {
                                fontSize: '14px'
                            }
                        },
                        plotBands: [{
                            from: 0,
                            to: 50,
                            color: '#DF5353', // red
                            thickness: 20
                        }, {
                            from: 50,
                            to: 100,
                            color: '#DDDF0D', // yellow
                            thickness: 20
                        }, {
                            from: 100,
                            to: 150,
                            color: '#55BF3B', // green
                            thickness: 20

                        }, {
                            from: 150,
                            to: 200,
                            color: '#4F77AA', // blue
                            thickness: 20

                        }]
                    },

                    series: [{
                        name: 'Kumulatif Saidi',
                        data: [@php echo round(abs(($saidiKumulatifValue/$saidiTargetKumulatifValue)-2),2) @endphp],
                        tooltip: {
                            valueSuffix: ' %'
                        },
                        dataLabels: {
                            format: '{y} %',
                            borderWidth: 0,
                            color: (
                                Highcharts.defaultOptions.title &&
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || '#333333',
                            style: {
                                fontSize: '12px'
                            }
                        },
                        dial: {
                            radius: '80%',
                            backgroundColor: 'gray',
                            baseWidth: 12,
                            baseLength: '0%',
                            rearLength: '0%'
                        },
                        pivot: {
                            backgroundColor: 'gray',
                            radius: 6
                        }

                    }]

                });
            </script>

            {{-- Gauge Saifi --}}
            <script>
                Highcharts.chart('saifiBulgauge', {
                    {{ $saifiHarianValue = null }}
                    {{ $saifiTargetValue = null }}
                    {{ $saifiMaxValue = null }}
                    @for ($hari = 1; $hari <= $jml_hr; $hari++)
                        @php $saifiHarianValue += $realisasi['harian_saifi'][$hari] @endphp
                    @endfor
                    @foreach ($ulp_target1 as $target2_ulp)
                        @php $saifiTargetValue = ($target2_ulp->target2_ulp)/12 @endphp
                    @endforeach
                    @php $saifiMaxValue = abs((abs(abs(($saifiHarianValue/$saifiTargetValue)-2)+0.02)-4)*100) @endphp


                    chart: {
                        type: 'gauge',
                        plotBackgroundColor: null,
                        plotBackgroundImage: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                        height: '50%'
                    },

                    title: {
                        text: 'Bulanan Saifi'
                    },
                    credits: {
                        enabled: false
                    },
                    navigation: {
                        buttonOptions: {
                            enabled: false
                        }
                    },
                    pane: {
                        startAngle: -90,
                        endAngle: 89.9,
                        background: null,
                        center: ['50%', '75%'],
                        size: '110%'
                    },

                    // the value axis
                    yAxis: {
                        min: 0,
                        max: 200,
                        tickPixelInterval: 0,
                        tickPosition: 'inside',
                        tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                        tickLength: 25,
                        tickWidth: 2,
                        minorTickInterval: null,
                        labels: {
                            distance: 30,
                            style: {
                                fontSize: '14px'
                            }
                        },
                        plotBands: [{
                            from: 0,
                            to: 50,
                            color: '#DF5353', // red
                            thickness: 20
                        }, {
                            from: 50,
                            to: 100,
                            color: '#DDDF0D', // yellow
                            thickness: 20
                        }, {
                            from: 100,
                            to: 150,
                            color: '#55BF3B', // green
                            thickness: 20

                        }, {
                            from: 150,
                            to: 200,
                            color: '#4F77AA', // blue
                            thickness: 20

                        }]
                    },

                    series: [{
                        name: 'Bulanan Saidi',
                        data: [
                            @php echo round(abs(($saifiTargetValue/$saifiHarianValue)-2)*100,2)  @endphp
                        ],
                        tooltip: {
                            valueSuffix: ' %'
                        },
                        dataLabels: {
                            format: '{y} %',
                            borderWidth: 0,
                            color: (
                                Highcharts.defaultOptions.title &&
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || '#333333',
                            style: {
                                fontSize: '12px'
                            }
                        },
                        dial: {
                            radius: '80%',
                            backgroundColor: 'gray',
                            baseWidth: 12,
                            baseLength: '0%',
                            rearLength: '0%'
                        },
                        pivot: {
                            backgroundColor: 'gray',
                            radius: 6
                        }

                    }]

                });
            </script>

            <script>
                Highcharts.chart('saifiKumgauge', {
                    {{ $saifiKumulatifValue = null }}
                    {{ $saifiTargetKumulatifValue = null }}
                    {{ $saifiKumulatiMaxfValue = null }}
                    @for ($hari = 1; $hari <= $jml_hr; $hari++)
                        @php $saifiKumulatifValue += $realisasi['relekum_saifi'][$hari] @endphp
                    @endfor
                    @foreach ($ulp_target1 as $target2_ulp)
                        @php $saifiTargetKumulatifValue = $target2_ulp->target2_ulp @endphp
                    @endforeach
                    @php $saifiKumulatiMaxfValue = abs((abs(($saifiKumulatifValue/$saifiTargetKumulatifValue)-2)+0.02)-4) @endphp
                    chart: {
                        type: 'gauge',
                        plotBackgroundColor: null,
                        plotBackgroundImage: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                        height: '50%'
                    },

                    title: {
                        text: 'Kumulatif Saifi'
                    },
                    credits: {
                        enabled: false
                    },
                    navigation: {
                        buttonOptions: {
                            enabled: false
                        }
                    },
                    pane: {
                        startAngle: -90,
                        endAngle: 89.9,
                        background: null,
                        center: ['50%', '75%'],
                        size: '110%'
                    },

                    // the value axis
                    yAxis: {
                        min: 0,
                        max: 200,
                        tickPixelInterval: 0,
                        tickPosition: 'inside',
                        tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                        tickLength: 20,
                        tickWidth: 2,
                        minorTickInterval: null,
                        labels: {
                            distance: 30,
                            style: {
                                fontSize: '14px'
                            }
                        },
                        plotBands: [{
                            from: 0,
                            to: 50,
                            color: '#DF5353', // red
                            thickness: 20
                        }, {
                            from: 50,
                            to: 100,
                            color: '#DDDF0D', // yellow
                            thickness: 20
                        }, {
                            from: 100,
                            to: 150,
                            color: '#55BF3B', // green
                            thickness: 20

                        }, {
                            from: 150,
                            to: 200,
                            color: '#4F77AA', // blue
                            thickness: 20

                        }]
                    },

                    series: [{
                        name: 'Kumulatif Saifi',
                        data: [@php echo round((2-($saidiTargetKumulatifValue/$saidiKumulatifValue))*100,2) @endphp],
                        tooltip: {
                            valueSuffix: ' %'
                        },
                        dataLabels: {
                            format: '{y} %',
                            borderWidth: 0,
                            color: (
                                Highcharts.defaultOptions.title &&
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || '#333333',
                            style: {
                                fontSize: '12px'
                            }
                        },
                        dial: {
                            radius: '80%',
                            backgroundColor: 'gray',
                            baseWidth: 12,
                            baseLength: '0%',
                            rearLength: '0%'
                        },
                        pivot: {
                            backgroundColor: 'gray',
                            radius: 6
                        }

                    }]

                });
            </script>
            <script src="{{ asset('assets/js/flickity.pkgd.min.js') }}"></script>
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
