@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row layout-top-spacing">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-two">
                <div class="widget-heading mb-3">
                    <h5 class="mb-3">Statistik Mahasiswa & Alumni</h5>
                    <form method="GET" action="{{ route('dashboard.index') }}">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="grow">
                                <label class="form-label small text-muted">Tahun Masuk</label>
                                <input
                                    type="number"
                                    name="entry_year"
                                    class="form-control py-2"
                                    value="{{ $userChart['entry_year'] }}"
                                    placeholder="..."
                                >
                            </div>

                            <div>
                                <button class="btn btn-primary">
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="widget-content text-center">
                    <div id="userDonutChart"></div>

                    <div class="mt-3 px-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Alumni</span>
                            <strong>{{ $userChart['alumni'] }}</strong>
                        </div>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Mahasiswa</span>
                            <strong>{{ $userChart['student'] }}</strong>
                        </div>

                        <hr class="my-2">

                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">
                                {{ $userChart['alumni'] + $userChart['student'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-two">
                <div class="widget-heading mb-3">
                    <h5 class="mb-3">Pengisian Tracer Study Alumni</h5>
                    <form method="GET" action="{{ route('dashboard.index') }}">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="grow">
                                <label class="form-label small text-muted">Tahun Lulus</label>
                                <input
                                    type="number"
                                    name="graduation_year"
                                    class="form-control py-2"
                                    value="{{ $tracerChart['graduation_year'] }}"
                                    placeholder="..."
                                >
                            </div>

                            <div>
                                <button class="btn btn-primary">
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="widget-content text-center">
                    <div id="tracerStudyDonutChart"></div>

                    <div class="mt-3 px-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Lengkap</span>
                            <strong>{{ $tracerChart['completed'] }}</strong>
                        </div>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Belum Lengkap</span>
                            <strong>{{ $tracerChart['incomplete'] }}</strong>
                        </div>

                        <hr class="my-2">

                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Alumni</span>
                            <span class="fw-bold">
                                {{ $tracerChart['completed'] + $tracerChart['incomplete'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <style>
                #infoSum .small {
                    font-size: 12px;
                }
            </style>
            <div class="widget widget-three">
                <div class="widget-heading mb-3">
                    <h5 class="mb-3">Ringkasan Informasi</h5>
                </div>
                <div class="widget-content" id="infoSum">

                    <!-- Info Kampus -->
                    <div class="">
                        <h6 class="text-muted mb-2">Informasi Kampus</h6>
                        <h3 class="fw-bold mb-3">
                            {{ number_format($dashboard['campus_information']['total']) }}
                        </h3>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="">Aktif</span>
                            <strong>
                                {{ number_format($dashboard['campus_information']['active']) }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between small">
                            <span class="">Berakhir</span>
                            <strong>
                                {{ number_format($dashboard['campus_information']['ended']) }}
                            </strong>
                        </div>
                    </div>

                    <hr>
                    
                    <!-- Info Loker -->
                    <div class="">
                        <h6 class="text-muted mb-2">Informasi Loker</h6>
                        <h3 class="fw-bold mb-3">
                            {{ number_format($dashboard['job_vacancy']['total']) }}
                        </h3>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="">Pending</span>
                            <strong>
                                {{ number_format($dashboard['job_vacancy']['pending']) }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="">Aktif / Disetujui</span>
                            <strong>
                                {{ number_format($dashboard['job_vacancy']['approved']) }}
                            </strong>
                        </div>
                    </div>

                    <hr>
                    
                    <!-- Info Magang -->
                    <div class="">
                        <h6 class="text-muted mb-2">Informasi Magang</h6>
                        <h3 class="fw-bold mb-3">
                            {{ number_format($dashboard['apprenticeship']['total']) }}
                        </h3>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="">Pending</span>
                            <strong>
                                {{ number_format($dashboard['apprenticeship']['pending']) }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between small">
                            <span class="">Aktif / Disetujui</span>
                            <strong>
                                {{ number_format($dashboard['apprenticeship']['approved']) }}
                            </strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        function renderDonutChart(elementId, seriesData, labels, colors, totalLabel = 'Total') {

            const total = seriesData.reduce((a, b) => a + b, 0);

            const options = {

                chart: {
                    type: 'donut',
                    height: 300
                },

                series: seriesData,

                labels: labels,

                colors: colors,

                legend: {
                    position: 'bottom',
                    fontSize: '13px'
                },

                dataLabels: {
                    enabled: false
                },

                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,

                                total: {
                                    show: true,
                                    label: totalLabel,
                                    fontSize: '16px',
                                    fontWeight: 600,
                                    formatter: function () {
                                        return total
                                    }
                                }
                            }
                        }
                    }
                }

            };

            const chart = new ApexCharts(
                document.querySelector(elementId),
                options
            );

            chart.render();
        }


        /* =========================
        USER CHART
        ========================= */

        const alumni = {{ $userChart['alumni'] }};
        const student = {{ $userChart['student'] }};

        renderDonutChart(
            "#userDonutChart",
            [alumni, student],
            ['Alumni', 'Mahasiswa'],
            ['#1e3a8a', '#3b82f6'],
            'Total'
        );


        /* =========================
        TRACER STUDY CHART
        ========================= */

        const tracerCompleted = {{ $tracerChart['completed'] }};
        const tracerIncomplete = {{ $tracerChart['incomplete'] }};

        renderDonutChart(
            "#tracerStudyDonutChart",
            [tracerCompleted, tracerIncomplete],
            ['Lengkap', 'Belum Lengkap'],
            ['#2563eb', '#e5e7eb'],
            'Tracer'
        );

    });
</script>
@endsection
