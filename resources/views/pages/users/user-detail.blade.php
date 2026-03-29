@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/users/students') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pengguna</li>
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
                            <h4>Detail Pengguna</h4>
                        </div>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="widget-content widget-content-area border-0">

                    <div class="row">
                        <div class="col-md-6">
                            {{-- ================= DATA UTAMA USER ================= --}}
                            <h6 class="mb-3"><strong>Informasi Akun</strong></h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="220">Nama</th>
                                    <td>{{ $user['name'] }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user['email'] }}</td>
                                </tr>
                                <tr>
                                    <th>Peran</th>
                                    <td>
                                        @if ($user['role'] === 'alumni') Alumni
                                        @elseif ($user['role'] === 'student') Mahasiswa
                                        @else {{ ucfirst($user['role']) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Pengguna</th>
                                    <td>
                                        @if ($user['status'] == 'pending') Menunggu
                                        @elseif ($user['status'] == 'active') Disetujui
                                        @elseif ($user['status'] == 'rejected') Ditolak
                                        @elseif ($user['status'] == 'banned') Diblokir
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            {{-- ================= TRACER STUDY ================= --}}
                            @if (!empty($user['tracer_study']))
                                <h6 class="mb-3"><strong>Data Akademik</strong></h6>
                                <table class="table table-sm">
                                    <tr>
                                        <th width="220">NIM / NPM</th>
                                        <td>{{ $user['tracer_study']['student_id_number'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fakultas</th>
                                        <td>{{ $user['tracer_study']['faculty']['name'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>
                                            {{ $user['tracer_study']['study_program']['name'] ?? '-' }}
                                            {{ $user['tracer_study']['study_program']['degree'] ? '(' . $user['tracer_study']['study_program']['degree'] . ')' : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Masuk</th>
                                        <td>{{ $user['tracer_study']['entry_year'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Lulus</th>
                                        <td>{{ $user['tracer_study']['graduation_year'] ?? '-' }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Domisili</th>
                                        <td>{{ $user['tracer_study']['domicile'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. WhatsApp</th>
                                        <td>{{ $user['tracer_study']['whatsapp_number'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Kerja</th>
                                        <td>{{ $user['tracer_study']['current_workplace'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Posisi / Jabatan</th>
                                        <td>{{ $user['tracer_study']['job_title'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Skala Perusahaan</th>
                                        <td>{{ $user['tracer_study']['company_scale'] ?? '-' }}</td>
                                    </tr> --}}
                                </table>
                            @endif
                        </div>
                    </div>

                    {{-- ================= ACTION ================= --}}
                    <hr>
                    <div class="mt-4 d-flex justify-content-between gap-2">
                        @if (!$is_same_faculty)
                            <div></div>
                        @else
                            <div class="d-flex gap-2">
                                <label class="form-label">Ubah Status Pengguna</label>

                                <!-- Approve -->
                                <form method="POST" action="{{ route('users.approve', $user['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <button class="btn {{ $user['status'] === 'active' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                        style="width:100px">
                                        Setujui
                                    </button>
                                </form>

                                <!-- Reject -->
                                <form method="POST" action="{{ route('users.reject', $user['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <button class="btn {{ $user['status'] === 'rejected' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                        style="width:100px">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        @endif
                        

                        <!-- Back -->
                        <div class="">
                            <a href="{{ route('users.index') }}" 
                                class="btn btn-primary">
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
