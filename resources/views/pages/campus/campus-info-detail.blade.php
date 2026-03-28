@extends('layouts.app')

@section('title', 'Detail Informasi Kampus')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('campus-info.index') }}">Informasi Kampus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Informasi Kampus</li>
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
                            <h4>Detail Informasi Kampus</h4>
                        </div>
                    </div>
                </div>

                <!-- ISI -->
                <div class="widget-content widget-content-area border-0">

                    <div>
                        {{-- Judul --}}
                        <h4>{{ $campusInfo['title'] }}</h4>

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Fakultas --}}
                                <p class="text-muted mb-1">
                                    {{ $campusInfo['faculty']['name'] ?? 'Global (Semua Fakultas)' }}
                                </p>

                                {{-- Status --}}
                                @php
                                    $statusClasses = [
                                        'active'    => 'badge-primary',
                                        'ended'     => 'badge-danger',
                                    ];
                                @endphp
                                <span class="badge {{ $statusClasses[$campusInfo['status']] ?? 'badge-light-secondary' }} mb-3" style="width: 90px;">
                                    @if ($campusInfo['status'] == 'active') Aktif
                                    @elseif ($campusInfo['status'] == 'ended') Berakhir
                                    @endif
                                </span>

                                <hr>

                                {{-- Deskripsi --}}
                                <h6>Deskripsi</h6>
                                <p>
                                    {!! nl2br(e($campusInfo['description'] ?? '-')) !!}
                                </p>

                                <hr>

                                {{-- Informasi Tambahan --}}
                                <h6>Informasi Tambahan</h6>
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Dibuat oleh:</strong>
                                        {{ $campusInfo['user']['name'] ?? '-' }}
                                    </li>
                                    <li>
                                        <strong>Email:</strong>
                                        {{ $campusInfo['user']['email'] ?? '-' }}
                                    </li>
                                    <li>
                                        <strong>Tanggal dibuat:</strong>
                                        {{ \Carbon\Carbon::parse($campusInfo['created_at'])->format('d M Y') }}
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-6 text-center rounded bg-light py-2">
                                {{-- Gambar --}}
                                @if (!empty($campusInfo['image_url']))
                                    <div class="">
                                        <img src="{{ $campusInfo['image_url'] }}"
                                            alt="Gambar Informasi Kampus"
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

                        {{-- ACTION --}}
                        <hr>
                        <div class="mt-4 d-flex justify-content-end gap-2">

                            {{-- End --}}
                            {{-- @if ($campusInfo['status'] === 'active')
                                <form method="POST"
                                      action="{{ route('campus-info.end', $campusInfo['id']) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-outline-primary"
                                            style="width:100px">
                                        Akhiri
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-primary" disabled style="width:100px">
                                    Berakhir
                                </button>
                            @endif --}}

                            {{-- Edit --}}
                            @if ($campusInfo['created_by'] === session('auth.user.id'))
                                <a href="{{ route('campus-info.edit', $campusInfo['id']) }}"
                                class="btn btn-primary"
                                style="width:100px">
                                    Edit
                                </a>
                            @endif

                            {{-- Back --}}
                            <div class="">
                                <a href="{{ route('campus-info.index') }}" class="btn btn-primary">
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
