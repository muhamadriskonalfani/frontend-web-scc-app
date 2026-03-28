@extends('layouts.app')

@section('title', 'Informasi Magang')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/apprenticeship/index') }}">Info Karir</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Informasi Magang</li>
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
                            <h4>Daftar Informasi Magang</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area border-0 pt-2">

                    <!-- DAFTAR FILTER -->
                    <div class="d-flex justify-content-start align-items-end mb-3">
                        <div class="">
                            <form method="GET" class="d-flex align-items-end gap-2">
                                <div class="w-100">
                                    <label class="form-label">Nama Pembuat</label>
                                    <input type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="form-control py-2"
                                        placeholder="...">
                                </div>

                                <div class="w-100">
                                    <label class="form-label">Tanggal Dibuat</label>
                                    <input type="date" name="from_date" class="form-control py-2">
                                </div>
                                
                                <div class="w-100">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" name="company_name" class="form-control py-2"
                                        placeholder="..."
                                        value="{{ request('company_name') }}">
                                </div>

                                <div class="w-100">
                                    <label class="form-label">Status Info</label>
                                    <select name="status" class="form-select py-2">
                                        <option value="">-- Semua --</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Disetujui</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="ended">Berakhir</option>
                                    </select>
                                </div>

                                {{-- <div class="w-100">
                                    <input type="date" name="to_date" class="form-control">
                                </div> --}}

                                <div class="" style="width: 100px;">
                                    <button class="btn btn-primary w-100">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- TABEL -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">No</th>
                                    <th class="text-start">Dibuat Oleh</th>
                                    <th class="text-start">Perusahaan</th>
                                    <th class="text-start">Posisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statusClasses = [
                                        'pending'   => 'badge-light-warning',
                                        'approved'  => 'badge-light-primary',
                                        'rejected'  => 'badge-light-danger',
                                        'ended'     => 'badge-light-secondary',
                                    ];
                                @endphp

                                @forelse ($apprenticeships as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start text-wrap">{{ $item['creator']['name'] ?? '-' }}</td>
                                        <td class="text-start text-wrap">{{ $item['company_name'] }}</td>
                                        <td class="text-start text-wrap">{{ $item['title'] }}</td>
                                        <td>
                                            <span class="badge {{ $statusClasses[$item['status']] ?? 'badge-light-secondary' }}" style="width: 90px;">
                                                @if ($item['status'] == 'pending') Menunggu
                                                @elseif ($item['status'] == 'approved') Disetujui
                                                @elseif ($item['status'] == 'rejected') Ditolak
                                                @elseif ($item['status'] == 'ended') Berakhir
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('apprenticeship.show', $item['id']) }}" style="cursor: pointer;" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Tidak ada data
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
