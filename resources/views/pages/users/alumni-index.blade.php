@extends('layouts.app')

@section('title', 'Daftar Alumni')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/users/alumni') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Alumni</li>
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
                            <h4>Daftar Alumni</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area border-0 pt-2">

                    <!-- DAFTAR FILTER -->
                    <div class="d-flex justify-content-start align-items-end mb-3">
                        <div class="">
                            <form method="GET" class="d-flex align-items-end gap-2">
                                <div class="w-100">
                                    <label class="form-label">Pencarian</label>
                                    <input type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="form-control py-2"
                                        placeholder="Nama / Email / NIM">
                                </div>
                                
                                <div class="w-100">
                                    <label class="form-label">Status Alumni</label>
                                    <select name="status" class="form-select py-2">
                                        <option value="">-- Semua --</option>
                                        <option value="pending"
                                            {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="active" 
                                            {{ request('status') == 'active' ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="rejected" 
                                            {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>

                                <div class="w-100">
                                    <label class="form-label">Tahun Lulus</label>
                                    <input type="text" name="graduation_year" class="form-control py-2" placeholder="..." value="{{ request('graduation_year') }}">
                                </div>

                                <div class="" style="width: 100px;">
                                    <button class="btn btn-primary w-100">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- TABEL -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead class="">
                                <tr>
                                    <th style="width: 20px;">No</th>
                                    <th class="text-start">Nama</th>
                                    <th class="text-start">Email</th>
                                    <th class="text-start">Prodi</th>
                                    <th>NIM</th>
                                    <th>Tahun Lulus</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statusClasses = [
                                        'pending'   => 'badge-light-warning',
                                        'active'    => 'badge-light-primary',
                                        'rejected'  => 'badge-light-danger',
                                        'banned'    => 'badge-light-secondary',
                                    ];
                                @endphp

                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start text-wrap">{{ $user['name'] }}</td>
                                        <td class="text-start text-wrap">{{ $user['email'] }}</td>
                                        <td class="text-start text-wrap">{{ $user['tracer_study']['study_program']['name'] ?? '-' }}</td>
                                        <td>{{ $user['tracer_study']['student_id_number'] ?? '-' }}</td>
                                        <td>{{ $user['tracer_study']['graduation_year'] ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $statusClasses[$user['status']] ?? 'badge-light-secondary' }}" style="width: 90px;">
                                                @if ($user['status'] == 'pending') Menunggu
                                                @elseif ($user['status'] == 'active') Disetujui
                                                @elseif ($user['status'] == 'rejected') Ditolak
                                                @elseif ($user['status'] == 'banned') Diblokir
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('users.show', $user['id']) }}" style="cursor: pointer;" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-3">
                                            Data tidak ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
