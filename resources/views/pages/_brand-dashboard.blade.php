@extends('layout')

@section('afterTitle', true)
@section('title', 'Markalar')

@section('pages-styles')
<style>
    .admodel-colorbox {
        background-color:#FE7044;
        color:#ffffff;
        text-align: center;
        width:50px;
        display:inline-block;
        font-weight: 500;
        padding:3px;
    }
    .admodel-colorbox.cpc{ background-color:#A2A7FE; color:#ffffff; }
    .admodel-colorbox.cps{ background-color:#76E7CA; color:#ffffff; }
    .admodel-colorbox.cpm{ background-color:#FFC629; color:#ffffff; }
    .admodel-colorbox.cpi{ background-color:#FF7D97; color:#ffffff; }
    .admodel-colorbox.cpv{ background-color:#f9ab95; color:#ffffff; }

    table.dataTable tbody tr:hover{ background-color:#f4f5f8; }
    body.dark-only table.dataTable tbody tr:hover{ background-color:#0c0c0c; }
    select.dt-input{border:0;}
    .card-status-pasif{ opacity: .56;}
    .page-wrapper.horizontal-wrapper .page-body-wrapper .page-body{margin-top:84px;}
    .page-wrapper.horizontal-wrapper .page-body-wrapper .sidebar-wrapper{display: none;}
    body .page-wrapper .page-header .header-logo-wrapper { margin: -9px 0; }
</style>
@endsection
@section('content')
    <!-- page-wrapper Start-->
    <div class="page-wrapper horizontal-wrapper" id="pageWrapper"> {{-- page-wrapper compact-wrapper --}}

        @include('includes.topbar')

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            @include('includes.navbar-basic')

            <div class="page-body pt-4">
                {{--
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>{{ $brand->name }}</h3>
                                <div class="pt-2 text-gray">{{ nl2br($group->notes) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                --}}
                <!-- Container-fluid starts-->
                <div class="container-fluid dashboard-5">
                    <div class="row">
                        <div class="col-12 od-xl-1">
                            <div class="row">

                                @foreach ($platformMetrics as $metric)
                                    <div class="col s-xxl-3 box-col-4">
                                        <div class="card social-widget widget-hover card-status-{{ strtolower($metric['status']) }}">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="social-icons">
                                                            <img src="{{ asset('assets/images/customs/icons/social/' . strtolower($metric['platform']) . '.png') }}"
                                                                alt="{{ $metric['platform'] }} icon">
                                                        </div>
                                                        <span>{{ $metric['platform'] }}</span>
                                                    </div>
                                                    <span
                                                        class="font-success f-12 d-xxl-block">{{ $metric['status'] }}</span>
                                                </div>
                                                <div class="social-content">
                                                    <div>
                                                        <h5 class="mb-1 counter"
                                                            data-target="{{ $metric['metric_value'] }}">0</h5><span
                                                            class="f-light">{{ $metric['metric_name'] }}</span>
                                                    </div>
                                                    <div class="social-chart">
                                                        <div class="js-social-radial"
                                                            data-target="{{ $metric['metric_percentage'] }}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-md-5 od-xl-2 box-col-4">


                            <div class="card profile-box">
                                <div class="card-body">
                                    <div class="d-flex media-wrapper justify-content-between">

                                            <div class="greeting-user">
                                                <h2 class="f-w-600 pb-3">Hoşgeldin <br>{{ $brand->name }}</h2>
                                                @if ($highestConversionCampaign['campaign'])
                                                    <div style="max-width:70%;">{{ $highestConversionCampaign['campaign']->campaign_name }}
                                                        kampanyasında toplam
                                                        {{ Number::format($highestConversionCampaign['highest_value'], locale:'tr') }}
                                                        @php
                                                        switch ($highestConversionCampaign['highest_metric_name']) {
                                                            case 'Tıklamalar':
                                                                echo 'tıklama';
                                                                break;
                                                            case 'Satışlar':
                                                                echo 'satış';
                                                            case 'İzlenmeler':
                                                                echo 'izlenme';
                                                                break;
                                                            case 'İndirmeler':
                                                                echo 'indirme';
                                                                break;
                                                            case 'Görüntülemeler':
                                                                echo 'görüntüleme';
                                                                break;
                                                            default:
                                                                echo 'işlem';
                                                                break;
                                                        }
                                                        @endphp
                                                        gerçekleşti.</div>
                                                @else
                                                    <p>Bugün için kaydedilmiş bir dönüşüm bulunmuyor.</p>
                                                @endif
                                            </div>
                                        <div>
                                            <div class="clockbox">
                                                <svg id="clock" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 600 600">
                                                    <g id="face">
                                                        <circle class="circle" cx="300" cy="300" r="253.9">
                                                        </circle>
                                                        <path class="hour-marks"
                                                            d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6">
                                                        </path>
                                                        <circle class="mid-circle" cx="300" cy="300" r="16.2">
                                                        </circle>
                                                    </g>
                                                    <g id="hour">
                                                        <path class="hour-hand" d="M300.5 298V142"></path>
                                                        <circle class="sizing-box" cx="300" cy="300" r="253.9">
                                                        </circle>
                                                    </g>
                                                    <g id="minute">
                                                        <path class="minute-hand" d="M300.5 298V67"> </path>
                                                        <circle class="sizing-box" cx="300" cy="300" r="253.9">
                                                        </circle>
                                                    </g>
                                                    <g id="second">
                                                        <path class="second-hand" d="M300.5 350V55"></path>
                                                        <circle class="sizing-box" cx="300" cy="300" r="253.9">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="badge f-10 p-0 w-100 text-center" id="txt_clock"></div>
                                        </div>
                                    </div>
                                    <div class="cartoon"><img class="rounded-circle"
                                            src="@if($brand->logo) {{ asset('storage/logos/' . $brand->logo) }} @else {{ asset('assets/images/customs/default-brand-logo.png') }} @endif"
                                            alt="brand logo" width="140" style="max-height:140px; border-radius:50%; object-fit:contain;"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xxl-6 col-xl-4 od-xl-4 box-col-4">

                            <div class="row">
                                <div class="col-4">
                                    <div class="card small-widget">
                                        <div class="card-body warning"> <span class="f-light">Planlanan Bütçe</span>
                                            <div class="d-flex align-items-end gap-1">
                                                <h4><span class="counter" data-target="{{ $totals['planned'] }}">0</span>₺
                                                </h4>
                                            </div>
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="{{ asset('assets/svg/icon-sprite.svg#profit') }}"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card small-widget">
                                        <div class="card-body success"><span class="f-light">Harcanan Bütçe</span>
                                            <div class="d-flex align-items-end gap-1">
                                                <h4><span class="counter" data-target="{{ $totals['spent'] }}">0</span>₺
                                                </h4>
                                            </div>
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="{{ asset('assets/svg/icon-sprite.svg#profit') }}"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card small-widget">
                                        <div class="card-body secondary"><span class="f-light">Toplam Tıklama</span>
                                            <div class="d-flex align-items-end gap-1">
                                                <h4><span class="counter" data-target="{{ $totals['clicks'] }}">0</span>
                                                </h4>
                                            </div>
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="{{ asset('assets/svg/icon-sprite.svg#customers') }}"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card small-widget">
                                        <div class="card-body secondary"><span class="f-light">Toplam Gösterim</span>
                                            <div class="d-flex align-items-end gap-1">
                                                <h4><span class="counter"
                                                        data-target="{{ $totals['impressions'] }}">0</span></h4>
                                            </div>
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="{{ asset('assets/svg/icon-sprite.svg#customers') }}"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card small-widget">
                                        <div class="card-body primary"> <span class="f-light">Toplam İzlenme</span>
                                            <div class="d-flex align-items-end gap-1">
                                                <h4><span class="counter" data-target="{{ $totals['views'] }}">0</span>
                                                </h4>
                                            </div>
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="{{ asset('assets/svg/icon-sprite.svg#customers') }}"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card small-widget">
                                        <div class="card-body warning"><span class="f-light">Toplam Satış</span>
                                            <div class="d-flex align-items-end gap-1">
                                                <h4><span class="counter" data-target="{{ $totals['sales'] }}">0</span>
                                                </h4>
                                            </div>
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="{{ asset('assets/svg/icon-sprite.svg#new-order') }}"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-md-7 od-xl-3 box-col-4">

                            <div class="card monthly-header">
                                <div class="card-header card-no-border">
                                    <div class="header-top">
                                        <h5>Tüketim Oranı</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="monthly-target">
                                        <div class="position-relative" id="monthly_target"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-12 col-xl-4 box-col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Mecra Bazlı Bütçe</h5>
                                </div>
                                <div class="card-body p-0 chart-block">
                                    <div class="chart-overflow" id="pie-chart1"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xl-4 box-col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Kampanya Tipi</h5>
                                </div>
                                <div class="card-body p-0 chart-block">
                                    <div class="chart-overflow" id="pie-chart3"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xl-4 box-col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Kampanya Bazlı Bütçe</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <div class="chart-overflow" id="column-chart1"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12 col-xl-12 od-xl-12 box-col-12">
                            <div class="card heading-space">
                                <div class="card-header card-no-border">
                                    <div class="header-top">
                                        <h5 class="m-0">Tüm Kampanyalar</h5>
                                    </div>
                                </div>
                                <div class="card-body pt-0 px-0 campaign-table">
                                    <div class=" table-responsive currency-table stripe row-border order-column" style="width:100%">
                                        <table class="table" id="campaigns-table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Kampanya Adı<br>ID</th>
                                                    <th>Başlangıç<br>Bitiş</th>
                                                    <th>Reklam<br>Modeli</th>
                                                    <th>Kampanya<br>Tipi</th>
                                                    <th>Planlanan<br>Bütçe</th>
                                                    <th>Harcanan<br>Bütçe</th>
                                                    <th>Birim<br>Fiyat</th>
                                                    <th>Birim<br>Oranı(%)</th>
                                                    <th>Tıklama<br>Sayısı</th>
                                                    <th>Satış<br>Sayısı</th>
                                                    <th>Gösterim<br>Sayısı</th>
                                                    <th>İndirme<br>Sayısı</th>
                                                    <th>İzleme<br>Sayısı</th>
                                                    <th>Kampanya<br>Durumu</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($campaignList['campaignList'] as $campaign)
                                                    <tr>
                                                        <td class="border-icon">
                                                            <div>
                                                                <div class="social-circle border-0">
                                                                    <img src="{{ asset('assets/images/customs/icons/social/' . strtolower($campaign['platform']) . '.png') }}"
                                                                        alt="{{ $metric['platform'] }} icon">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $campaign->campaign_name }}<br>
                                                        <span class="text-gray">#{{ $campaign->campaign_id }}</span></td>
                                                        <td>{{ $campaign->start_date }}<br>
                                                        {{ $campaign->end_date }}</td>
                                                        <td>
                                                            <div class="admodel-colorbox {{ strtolower($campaign->ad_model) }}">
                                                            {{ $campaign->ad_model }}
                                                            </div>
                                                        </td>
                                                        <td>{{ $campaign->campaign_type }}</td>
                                                        <td>{{ Number::format((int) $campaign->planned, locale: 'tr') }}₺</td>
                                                        <td>{{ Number::format((int) $campaign->spent, locale: 'tr') }}₺</td>
                                                        <td>{{ Number::format($campaign->unit_price, locale: 'tr') }}₺</td>
                                                        <td>{{ $campaign->unit_percentage }}%</td>
                                                        <td>{{ Number::format($campaign->clicks, locale: 'tr') }}</td>
                                                        <td>{{ Number::format($campaign->sales, locale: 'tr') }}</td>
                                                        <td>{{ Number::format($campaign->impressions, locale: 'tr') }}</td>
                                                        <td>{{ Number::format($campaign->downloads, locale: 'tr') }}</td>
                                                        <td>{{ Number::format($campaign->views, locale: 'tr') }}</td>
                                                        <td>
                                                            <button
                                                                class="btn badge-light-primary">{{ $campaign->status }}</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td>Toplamlar:</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ Number::format($campaignList['totals']['planned'], locale: 'tr') }}₺</td>
                                                    <td>{{ Number::format($campaignList['totals']['spent'], locale: 'tr') }}₺</td>
                                                    <td>{{ Number::format((int) $campaignList['totals']['unit_price'], locale: 'tr') }}₺</td>
                                                    <td>{{ (int) $campaignList['totals']['unit_percentage'] }}%</td>
                                                    <td>{{ Number::format($campaignList['totals']['clicks'], locale: 'tr') }}</td>
                                                    <td>{{ Number::format($campaignList['totals']['sales'], locale: 'tr') }}</td>
                                                    <td>{{ Number::format($campaignList['totals']['impressions'], locale: 'tr') }}</td>
                                                    <td>{{ Number::format($campaignList['totals']['downloads'], locale: 'tr') }}</td>
                                                    <td>{{ Number::format($campaignList['totals']['views'], locale: 'tr') }}</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>


            @include('includes.footer')

        </div>
    </div>
@endsection

@section('pages-scripts')
    {{-- Page specific scripts --}}
    {{--
Sayfaya özel scriptleri aşağıdaki örnekler gibi ekleyin
Bir contact section'ı kullanılacaksa javascripti main.js'e tanımlanıp
her yerden "çağrılmamalı". contact.js gibi ona özel bir custom script
gerekir. Ayrıca varsa Nocaptcha gibi ek ihtiyaçlar da ilgili dosyadan
önce bu alana eklenmeli.
--}}

<script>
$(document).ready(function() {
    // CSRF tokenini AJAX isteklerine eklemek
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /******************* SOCIAL RADIAL CHART CONFS *********************/
    function radialCommonOption(data) {
        return {
            series: data.radialYseries,
            chart: {
                height: 130,
                type: "radialBar",
                dropShadow: {
                    enabled: true,
                    top: 3,
                    left: 0,
                    blur: 10,
                    color: data.dropshadowColor,
                    opacity: 0.35,
                },
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: "60%",
                    },
                    track: {
                        strokeWidth: "60%",
                        opacity: 1,
                        margin: 5,
                    },
                    dataLabels: {
                        showOn: "always",
                        value: {
                            color: "var(--body-font-color)",
                            fontSize: "14px",
                            show: true,
                            offsetY: -10,
                        },
                    },
                },
            },
            colors: data.color,
            stroke: {
                lineCap: "round",
            },
            responsive: [{
                breakpoint: 1500,
                options: {
                    chart: {
                        height: 130,
                    },
                },
            }, ],
        };
    }

    // Tüm js-social-radial sınıfına sahip elemanları seç
    var radialCharts = document.querySelectorAll('.js-social-radial');

    radialCharts.forEach(function(radialChart) {
        var targetValue = radialChart.getAttribute(
            'data-target'); // data-target attribute'ünden değeri al

        // Radial chart options
        var radialCustoms = {
            color: ["#57B9F6"],
            dropshadowColor: "#57B9F6",
            radialYseries: [parseFloat(targetValue)], // data-target değeri burada kullanılıyor
        };

        // ApexCharts instance oluştur ve render et
        var radialprogessChart = new ApexCharts(
            radialChart,
            radialCommonOption(radialCustoms)
        );

        radialprogessChart.render();
    });


    /******************* MONTHLY CHART CONFS *********************/
    // Monthly targets
    var monthlyTarget = {
        series: [{{ $consumptionRate }}],
        chart: {
            type: "radialBar",
            height: 320,
            offsetY: -20,
            sparkline: {
                enabled: true,
            },
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "65%",
                },
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: "#d7e2e9",
                    strokeWidth: "97%",
                    margin: 5,
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        color: "#999",
                        opacity: 1,
                        blur: 2,
                    },
                },
                dataLabels: {
                    name: {
                        show: true,
                        offsetY: -10,
                    },
                    value: {
                        show: true,
                        offsetY: -50,
                        fontSize: "18px",
                        fontWeight: "600",
                        color: "#2F2F3B",
                    },
                    total: {
                        show: true,
                        label: "Kalan : {{ $totals['remaining'] }}₺",
                        fontSize: "14px",
                        fontFamily: "Rubik, sans-serif",
                        fontWeight: 400,
                        formatter: function() {
                            return "{{ $consumptionRate }}%";
                        },
                    },
                },
            },
        },
        grid: {
            padding: {
                top: -10,
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                shadeIntensity: 0.4,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [100],
                colorStops: [{
                    offset: 0,
                    color: "#76E7CA",
                    opacity: 1,
                }, ],
            },
        },
        labels: ["Average Results"],
        responsive: [{
                breakpoint: 1591,
                options: {
                    chart: {
                        height: 270,
                    },
                },
            },
            {
                breakpoint: 1426,
                options: {
                    chart: {
                        height: 240,
                    },
                },
            },
            {
                breakpoint: 1331,
                options: {
                    chart: {
                        height: 210,
                    },
                    plotOptions: {
                        radialBar: {
                            dataLabels: {
                                value: {
                                    fontSize: "16px",
                                },
                                total: {
                                    fontSize: "13px",
                                },
                            },
                        },
                    },
                },
            },
            {
                breakpoint: 1233,
                options: {
                    chart: {
                        height: 200,
                    },
                },
            },
            {
                breakpoint: 768,
                options: {
                    chart: {
                        height: 250,
                    },
                },
            },
        ],
    };

    var monthlyChart = new ApexCharts(document.querySelector("#monthly_target"), monthlyTarget);
    monthlyChart.render();


    /******************* DATA TABLE CONFS *********************/
    $("#campaigns-table").DataTable({
        pageLength: 20,
        autoWidth: false,
        lengthMenu: [20, 40, 80, 160, 320],
        order: [
            [1, "asc"]
        ],
        scrollCollapse: true,
        select: {
            style: "multi",
            selector: "td:first-child",
        },
        searchable: true,
        responsive: true,

        "language": {
            "info": "_PAGES_ sayfada _PAGE_. gösteriliyor",
            "infoEmpty":      "İçerik yok",
            "search": "Arama",
            "infoPostFix":    "",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
        }
        //columnDefs: [{ width: 50, targets: 0 }],
        //fixedColumns: true,
    });



    /******************* LATEST CHARTS CONFS *********************/
    google.charts.load("current", {
        packages: ["corechart", "bar"]
    });
    google.charts.load("current", {
        packages: ["line"]
    });
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        // Mecra Bazlı Bütçe Dağılımı
        if ($("#pie-chart1").length > 0) {
            var data = google.visualization.arrayToDataTable([
                ["Platform", "Spent"],
                @foreach($budgetDistribution as $platform => $info)
                    ["{{ $platform }} : {{ number_format($info['spent'], 2, ',', '.') }}₺", {{ $info['spent'] }}],
                @endforeach
            ]);

            var options = {
                title: "Mecra Bazlı Bütçe Dağılımı",
                pieHole: 0.4,
                width: "100%",
                height: 300,
                colors: [
                    "#A2A7FE",
                    "#76E7CA",
                    "#FFC629",
                    "#FF7D97",
                    "#ECEAFF",
                    "#FE7044"
                ],
                legend: {
                    textStyle: {color: 'black', fontSize: 12}
                },
                chartArea:{left:50,top:50,bottom:30,right:40,width:"100%",height:"100%"},
                tooltip: {
                    trigger: 'hover',
                    text: 'value'
                },
                sliceVisibilityThreshold: 0
            };

            var chart = new google.visualization.PieChart(document.getElementById("pie-chart1"));
            chart.draw(data, options);
        }

        // Kampanya Tipi Dağılımı
        if ($("#pie-chart3").length > 0) {
            var data = google.visualization.arrayToDataTable([
                ["Campaign Type", "Count"],
                @foreach($campaignTypeDistribution as $type => $info)
                    ["{{ $type }} : {{ $info['count'] }}", {{ $info['count'] }}],
                @endforeach
            ]);
            var options = {
                title: "Kampanya Tipi Dağılımı",
                pieHole: 0.4,
                width: "100%",
                height: 300,
                colors: [
                    "#ffc629",
                    "#76E7CA",
                    "#FFC629",
                    "#FF7D97",
                    "#ECEAFF",
                    "#FE7044"
                ],
                legend: {
                    textStyle: {color: 'black', fontSize: 12}
                },
                chartArea:{left:50,top:50,bottom:30,right:40,width:"100%",height:"100%"},
                tooltip: {
                    trigger: 'hover',
                    text: 'value'
                },
                sliceVisibilityThreshold: 0
            };
            var chart = new google.visualization.PieChart(document.getElementById("pie-chart3"));
            chart.draw(data, options);
        }

        // Kampanya Bazlı Bütçe Dağılımı
        if ($("#column-chart1").length > 0) {
            var data = google.visualization.arrayToDataTable([
                ["Kampanya", "Planlanan", "Harcanan"],
                @foreach($campaignBudgetDistribution as $campaign)
                    ["{{ $campaign['campaign_name'] }}", {{ $campaign['planned'] }}, {{ $campaign['spent'] }}],
                @endforeach
            ]);

            var options = {
                bars: "vertical",
                vAxis: {
                    format: "decimal",
                },
                height: 230,
                width: "100%",
                colors: [
                    "#A2A7FE",
                    "#76E7CA",
                    "#FFC629",
                    "#FF7D97",
                    "#ECEAFF",
                    "#FE7044"
                ],
                legend: {
                    position: "none"
                },
                chartArea: {
                    width: '70%',
                    height: '70%'
                },
            };

            var chart = new google.charts.Bar(document.getElementById("column-chart1"));
            chart.draw(data, google.charts.Bar.convertOptions(options));

            // Title yerine manuel olarak legend ekleme
            var chartTitle = '<div style="text-align: center; margin-bottom: 10px;">';
            chartTitle += '<span style="color: #A2A7FE; font-weight: bold;">Planlanan</span> &nbsp;&nbsp;';
            chartTitle += '<span style="color: #76E7CA; font-weight: bold;">Harcanan</span>';
            chartTitle += '</div>';

            $('#column-chart1').prepend(chartTitle);
        }

    }

});
</script>
@endsection
