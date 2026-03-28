@extends('layouts.app')

@section('title', 'Detail Tracer Study Alumni')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tracer-study.index') }}">Tracer Study</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Tracer Study</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row layout-top-spacing">
        <div class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">

                <div class="widget-header border-0">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Detail Tracer Study</h4>
                        </div>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="widget-content widget-content-area border-0">

                    <div class="row">

                        <!-- ================= LEFT ================= -->
                        <div class="col-md-6">

                            <h6 class="mb-3 fw-bold">Informasi Akun</h6>

                            <table class="table table-sm">
                                <tr>
                                    <th width="200">Nama</th>
                                    <td>{{ $userTracerStudy['user']['name'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $userTracerStudy['user']['email'] ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>
                                        {{ $userTracerStudy['user']['profile']['gender'] == 'male' ? 'Laki-laki' : 'Perempuan' }}
                                    </td>
                                </tr>
                            </table>

                        </div>

                        <!-- ================= RIGHT ================= -->
                        <div class="col-md-6">

                            <h6 class="mb-3 fw-bold">Data Akademik & Karir</h6>

                            <table class="table table-sm">

                                <tr>
                                    <th width="200">NIM</th>
                                    <td>{{ $userTracerStudy['student_id_number'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Fakultas</th>
                                    <td>{{ $userTracerStudy['faculty']['name'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Program Studi</th>
                                    <td>{{ $userTracerStudy['study_program']['name'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Tahun Masuk</th>
                                    <td>{{ $userTracerStudy['entry_year'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Tahun Lulus</th>
                                    <td>{{ $userTracerStudy['graduation_year'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Status Kerja</th>
                                    <td>{{ ucfirst($userTracerStudy['employment_status'] ?? '-') }}</td>
                                </tr>

                                <tr>
                                    <th>Tempat Kerja</th>
                                    <td>{{ $userTracerStudy['current_workplace'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $userTracerStudy['job_title'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Skala Perusahaan</th>
                                    <td>{{ ucfirst($userTracerStudy['company_scale'] ?? '-') }}</td>
                                </tr>

                                <tr>
                                    <th>Jenis Pekerjaan</th>
                                    <td>{{ ucfirst($userTracerStudy['employment_type'] ?? '-') }}</td>
                                </tr>

                                <tr>
                                    <th>Sektor</th>
                                    <td>{{ strtoupper($userTracerStudy['employment_sector'] ?? '-') }}</td>
                                </tr>

                                <tr>
                                    <th>Gaji</th>
                                    <td>{{ $userTracerStudy['monthly_income_range'] ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Kesesuaian Studi</th>
                                    <td>{{ ucfirst($userTracerStudy['job_study_relevance_level'] ?? '-') }}</td>
                                </tr>

                                <tr>
                                    <th>Saran</th>
                                    <td>
                                        <div class="wrap-text">
                                            {{ $userTracerStudy['suggestion_for_university'] ?? '-' }}
                                        </div>
                                    </td>
                                </tr>

                            </table>

                        </div>

                    </div>

                    <!-- ACTION -->
                    <hr>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <div class="">
                            <a href="{{ route('tracer-study.index') }}" class="btn btn-primary">
                                Kembali
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /CONTENT -->

            </div>
        </div>
    </div>
</div>
@endsection
