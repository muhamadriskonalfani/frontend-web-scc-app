@extends('layouts.app')

@section('title', 'Detail Magang')

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
                        <h4>{{ $apprenticeship['title'] }}</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">{{ $apprenticeship['company_name'] }}</p>

                                <div class="mb-3">
                                    @php
                                        $statusClasses = [
                                            'pending'   => 'badge-light-warning',
                                            'approved'  => 'badge-light-primary',
                                            'rejected'  => 'badge-light-danger',
                                            'ended'     => 'badge-light-secondary',
                                        ];
                                    @endphp

                                    <span class="badge {{ $statusClasses[$apprenticeship['status']] ?? 'badge-light-secondary' }}" style="width: 90px;">
                                        @if ($apprenticeship['status'] == 'pending') Menunggu
                                        @elseif ($apprenticeship['status'] == 'approved') Disetujui
                                        @elseif ($apprenticeship['status'] == 'rejected') Ditolak
                                        @elseif ($apprenticeship['status'] == 'ended') Berakhir
                                        @endif
                                    </span>
                                </div>

                                <hr>

                                <h6>Deskripsi</h6>
                                <p>{{ $apprenticeship['description'] ?? '-' }}</p>

                                <hr>

                                <h6>Informasi Tambahan</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Dibuat oleh:</strong> {{ $apprenticeship['creator']['name'] ?? '-' }}</li>
                                    <li><strong>Disetujui oleh:</strong> {{ $apprenticeship['approver']['name'] ?? '-' }}</li>
                                    <li><strong>Tanggal dibuat:</strong> {{ \Carbon\Carbon::parse($apprenticeship['created_at'])->format('d M Y') }}</li>
                                </ul>
                            </div>

                            <div class="col-md-6 text-center rounded bg-light py-2">
                                {{-- Gambar --}}
                                @if (!empty($apprenticeship['image_url']))
                                    <div class="">
                                        <img src="{{ $apprenticeship['image_url'] }}"
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

                                {{-- Approve --}}
                                <form method="POST" action="{{ route('apprenticeship.approve', $apprenticeship['id']) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn {{ $apprenticeship['status'] === 'approved' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                            style="width:100px">
                                        Setujui
                                    </button>
                                </form>

                                {{-- Reject --}}
                                <form method="POST" action="{{ route('apprenticeship.reject', $apprenticeship['id']) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn {{ $apprenticeship['status'] === 'rejected' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                            style="width:100px">
                                        Tolak
                                    </button>
                                </form>

                                {{-- End --}}
                                <form method="POST" action="{{ route('apprenticeship.end', $apprenticeship['id']) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn {{ $apprenticeship['status'] === 'ended' ? 'btn-primary' : 'btn-outline-primary' }}" 
                                            style="width:100px">
                                        Akhiri
                                    </button>
                                </form>
                            </div>

                            {{-- Back --}}
                            <div class="">
                                <a href="{{ route('apprenticeship.index') }}" class="btn btn-primary">
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
