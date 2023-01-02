@extends('navbar.dash')

@section('content')
    <div>

    </div>
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

                <div class="imgcontainer" >
                    <img class="imglogo" src="{{ asset('assets/images/logo/logo-bumn.png') }}" />
                    <img class="imglogo" src="{{ asset('assets/images/logo/logo-pln.png') }}"
                        style="margin-top:2%; left:13%" />
                </div>

                <div class="text-center">
                    <h2><img src="{{ asset('assets/images/logo/logo-simodis.png') }}" style="width: 20vh; height:5vh" />
                    </h2>
                    {{-- <h2>Dashboard Kehandalan UP3 Pekanbaru Tahun 2022</h2> --}}
                    {{-- <h5>Monitoring Kinerja SAIDI SAIFI Harian UP3 Pekanbaru</h5> --}}
                    <h5>Sistem Monitoring Distribusi</h5>
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
                                <div class="col-2 mt-4" style="width:auto">
                                    <button class="btn btn-primary" type="submit">Refresh</button>
                                    <a class="btn btn-danger" href="{{ url('/main/rank') }}"> Reset </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="padding: 0px;">
                            <form method="GET" action="{{ url('/main/rank') }}">

                                <div class="card-body">
                                    <label style="margin-bottom: 10px">ULP</label>
                                    <div class="kolum">

                                        @for ($i = 0; $i < count($ulp_list + $up3_name); $i++)
                                            <?php
                                            
                                            $btn_active = '';
                                            $btn_active2 = '';
                                            if (isset($_GET['ulp'])) {
                                                if ($_GET['ulp'] == $up3_name[0]->nama_ulp) {
                                                    $btn_active2 = 'active';
                                                } elseif ($_GET['ulp'] == $ulp_list[$i]->nama_ulp) {
                                                    $btn_active = 'active';
                                                } else {
                                                    $btn_active = '';
                                                }
                                            }
                                            ?>
                                            <div class="tooltip">

                                                <div class="btn btn-primary {{ $btn_active }}" id="btnParent">
                                                    <input class="btntransparent" type="submit" name="ulp"
                                                        value="{{ $ulp_list[$i]->nama_ulp }}"/>
                                                       
                                                </div>
                                                <div class="top">
                                                    {{ $ulp_list[$i]->nama_ulp }}
                                                    <i></i>
                                                </div>
                                            </div>

                                            {{-- @php
                                                if (($i) / 2 == 0) {
                                                    echo '<div> </div>';
                                                } else {
                                                    echo '';
                                                }
                                            @endphp --}}
                                        @endfor

                                        <?php
                                        if (isset($_GET['bulan'])) {
                                            echo '<input type="text" name="bulan" value="' . $_GET['bulan'] . '" hidden />';
                                        } else {
                                            echo '<input type="text" name="bulan" value="1" hidden />';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                            <form method="GET" action="{{ url('/main/rank') }}">

                                <div class="card-body">
                                    <label style="margin-bottom: 10px">Bulan</label>
                                    <br>
                                    <div class="kolum">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <?php
                                            $btn_bulan_active = '';
                                            if (isset($_GET['bulan'])) {
                                                if ($_GET['bulan'] == $i) {
                                                    $btn_bulan_active = 'active';
                                                } else {
                                                    $btn_bulan_active = '';
                                                }
                                            }
                                            ?>
                                            @php
                                                $month_num = $i;
                                                $month_name = date('F', mktime(0, 0, 0, $month_num, 10));
                                            @endphp
                                            <div style="tooltip">
                                                <div class="btn btn-primary {{ $btn_bulan_active }}" id="btnParent">
                                                    <button class="btntransparent" type="submit" name="bulan"
                                                        value="{{ $i }}">
                                                        {{ $month_name }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['ulp'])) {
                                    echo '<input type="text" name="ulp" value="' . $_GET['ulp'] . '" hidden/> ';
                                } else {
                                    echo '<input type="text" name="ulp" value="' . $up3_name[0]->nama_ulp . '" hidden/> ';
                                }
                                ?>

                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div id="rank"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div id="kum-gangguan"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div id="fgtm"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="n_penyulang"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            function onSelect() {
                var x = document.getElementById("mySelect").value;
                // document.getElementById("demo").innerHTML = "You selected: " + x;
            }
        </script>

        <script>
            Highcharts.chart('rank', {
                chart: {
                    type: 'column',
                    height: '62%'
                },
                title: {
                    text: 'Realisasi SAIDI Perpenyulang'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        @foreach ($rank_saidi as $value)
                            '{{ $value->penyulang }}',
                        @endforeach
                    ],
                    crosshair: true,
                    labels: {
                        style: {
                            fontSize: '8px',
                        },
                        rotation: 270
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        color: '#009933'
                    },
                    series: {
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            y: -10
                        },
                        pointPadding: 0.1,
                        groupPadding: 0
                    }
                },
                series: [{
                    name: 'Rank SAIDI',
                    data: [
                        @foreach ($rank_saidi as $value)
                            {{ $value->ranksaidi }},
                        @endforeach
                    ]

                }]
            });
        </script>
        <script>
            Highcharts.chart('kum-gangguan', {
                title: {
                    text: 'Komulatif Gangguan Bulanan'
                },

                xAxis: {
                    categories: [
                        @foreach ($kum_gangguan as $value)
                            '{{ $value->rayon }}',
                        @endforeach
                    ]
                },
                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            y: -10
                        },
                        pointPadding: 0.1,
                        groupPadding: 0
                    }
                },
                series: [{
                    type: 'column',
                    name: 'Jumlah Gangguan',
                    data: [
                        {{ $n_gangguan }}
                    ]
                }]
            }, function(chart) {
                var text = chart.renderer.text(
                        'Total Gangguan : {{ $total_gangguan }}',
                        600,
                        70
                    ).attr({
                        zIndex: 5
                    }).add(),
                    textBox = text.getBBox();

                console.log(typeof chart.renderer);

                chart.renderer.rect(textBox.x - 10, textBox.y - 5, textBox.width + 20, textBox.height + 10, 2)
                    .attr({
                        fill: '#BADA55',
                        stroke: 'black',
                        'stroke-width': 1,
                        zIndex: 4
                    })
                    .add();
            });
        </script>
        <script>
            Highcharts.chart('fgtm', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'FGTM MoM UP3 PEKANBARU'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        @foreach ($fgtm as $value)
                            <?php if ($value->bulan == 1) {
                                echo "'Januari',";
                            } elseif ($value->bulan == 2) {
                                echo "'Februari',";
                            } elseif ($value->bulan == 3) {
                                echo "'Maret',";
                            } elseif ($value->bulan == 4) {
                                echo "'April',";
                            } elseif ($value->bulan == 5) {
                                echo "'Mei',";
                            } elseif ($value->bulan == 6) {
                                echo "'Juni',";
                            } elseif ($value->bulan == 7) {
                                echo "'Juli',";
                            } elseif ($value->bulan == 8) {
                                echo "'Agustus',";
                            } elseif ($value->bulan == 9) {
                                echo "'September',";
                            } elseif ($value->bulan == 10) {
                                echo "'Oktober',";
                            } elseif ($value->bulan == 11) {
                                echo "'November',";
                            } elseif ($value->bulan == 12) {
                                echo "'Desember',";
                            } ?>
                        @endforeach
                    ],
                    crosshair: true

                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        color: '#ff4000'
                    },
                    series: {
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            y: -10
                        },
                        pointPadding: 0.1,
                        groupPadding: 0
                    }
                },
                series: [{
                    name: 'Jumlah Gangguan',
                    data: [
                        @foreach ($fgtm as $value)
                            {{ $value->jml_gangguan }},
                        @endforeach
                    ]

                }]
            });
        </script>
        <script>
            Highcharts.chart('n_penyulang', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Gangguan Penyulang'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        @foreach ($kum_penyulang as $value)
                            '{{ $value->penyulang }}',
                        @endforeach
                    ],
                    crosshair: true,
                    labels: {
                        style: {
                            fontSize: '9px'
                        },
                        rotation: 270
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        color: '#000000'
                    },
                    series: {
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            y: -10
                        },
                        pointPadding: 0.1,
                        groupPadding: 0
                    }
                },
                series: [{
                    name: 'Jumlah Gangguan',
                    data: [
                        @foreach ($kum_penyulang as $value)
                            {{ $value->kum_gangguan }},
                        @endforeach
                    ]

                }]
            }, function(chart) {
                var text = chart.renderer.text(
                        'Total Gangguan : {{ $tg_penyulang }}',
                        900,
                        70
                    ).attr({
                        zIndex: 5
                    }).add(),
                    textBox = text.getBBox();

                console.log(typeof chart.renderer);

                chart.renderer.rect(textBox.x - 10, textBox.y - 5, textBox.width + 20, textBox.height + 10, 2)
                    .attr({
                        fill: '#BADA55',
                        stroke: 'black',
                        'stroke-width': 1,
                        zIndex: 4
                    })
                    .add();
            });
        </script>
    @endif

@endsection
