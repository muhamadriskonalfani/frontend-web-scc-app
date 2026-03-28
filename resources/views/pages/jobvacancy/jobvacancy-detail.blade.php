@extends('layouts.app')

@section('title', 'Detail Lowongan')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/apprenticeship/index') }}">Info Karir</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Informasi Magang</li>
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
                            <h4>Detail Informasi Magang</h4>
                        </div>
                    </div>
                </div>

                <!-- ISI HALAMAN -->
                <div class="widget-content widget-content-area border-0">

                    <div class="">
                        <h4>{{ $vacancy['title'] }}</h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">{{ $vacancy['company_name'] }}</p>

                                <div class="mb-3">
                                    @php
                                        $statusClasses = [
                                            'pending'   => 'badge-light-warning',
                                            'approved'  => 'badge-light-primary',
                                            'rejected'  => 'badge-light-danger',
                                            'ended'     => 'badge-light-secondary',
                                        ];
                                    @endphp

                                    <span class="badge {{ $statusClasses[$vacancy['status']] ?? 'badge-light-secondary' }}" style="width: 90px;">
                                        @if ($vacancy['status'] == 'pending') Menunggu
                                        @elseif ($vacancy['status'] == 'approved') Disetujui
                                        @elseif ($vacancy['status'] == 'rejected') Ditolak
                                        @elseif ($vacancy['status'] == 'ended') Berakhir
                                        @endif
                                    </span>
                                </div>

                                <hr>

                                <h6>Deskripsi</h6>
                                <p>{{ $vacancy['description'] ?? '-' }}</p>

                                <hr>

                                <h6>Informasi Tambahan</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Dibuat oleh:</strong> {{ $vacancy['creator']['name'] ?? '-' }}</li>
                                    <li><strong>Disetujui oleh:</strong> {{ $vacancy['approver']['name'] ?? '-' }}</li>
                                    <li><strong>Tanggal dibuat:</strong> {{ \Carbon\Carbon::parse($vacancy['created_at'])->format('d M Y') }}</li>
                                </ul>
                            </div>

                            <div class="col-md-6 text-center rounded bg-light py-2">
                                {{-- Gambar --}}
                                @if (!empty($vacancy['image_url']))
                                    <div class="">
                                        <img src="{{ $vacancy['image_url'] }}"
                                            alt="Gambar Informasi Karir"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 350px;">
                                    </div>
                                @else
                                    <div class="text-muted">
                                        Tidak ada gambar.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="mt-4 d-flex justify-content-between gap-2">
                            
                            <div class="d-flex gap-2">
                                <label class="form-label">Ubah Status Info</label>

                                <!-- Approve -->
                                <form method="POST" action="{{ route('jobvacancy.approve', $vacancy['id']) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn {{ $vacancy['status'] === 'approved' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                        style="width:100px">
                                        Setujui
                                    </button>
                                </form>

                                <!-- Reject -->
                                <form method="POST" action="{{ route('jobvacancy.reject', $vacancy['id']) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn {{ $vacancy['status'] === 'rejected' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                        style="width:100px">
                                        Tolak
                                    </button>
                                </form>

                                <!-- End -->
                                <form method="POST" action="{{ route('jobvacancy.end', $vacancy['id']) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn {{ $vacancy['status'] === 'ended' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                        style="width:100px">
                                        Akhiri
                                    </button>
                                </form>
                            </div>

                            {{-- Back --}}
                            <div class="">
                                <a href="{{ route('jobvacancy.index') }}" class="btn btn-primary">
                                    Kembali
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
