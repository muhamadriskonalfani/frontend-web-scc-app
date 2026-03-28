@extends('layouts.app')

@section('title', 'Informasi Kampus')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/campus-info/index') }}">Info Kampus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Informasi Kampus</li>
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
                            <h4>Daftar Informasi Kampus</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area border-0">

                    <div class="filtered-list-search mb-3 w-50 position-relative">
                        <form class="form-inline my-2 my-lg-0 justify-content-center">
                            <div class="w-100 position-relative">
                                <label for="input-search">Pencarian</label>
                                <input type="text" name="search" 
                                    class="py-2 w-100 form-control product-search pe-5" 
                                    id="input-search" placeholder="Judul" 
                                    value="{{ $search }}">
                            </div>
                        </form>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" style="width: 20px;">No</th>
                                    <th scope="col" class="text-start">Judul</th>
                                    <th scope="col" class="text-start">Ditujukan Untuk</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statusClasses = [
                                        'active'    => 'badge-light-primary',
                                        'ended'     => 'badge-light-secondary',
                                    ];
                                @endphp

                                @forelse($campusInfos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start text-wrap">
                                            {{ $item['title'] }}
                                        </td>
                                        <td class="text-start text-wrap">
                                            @if ($item['faculty_id'] === null)
                                                Semua Fakultas
                                            @else
                                                {{ $item['faculty']['name'] }}
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusClasses[$item['status']] ?? 'badge-light-secondary' }}" style="width: 90px;">
                                                @if ($item['status'] == 'active') Aktif
                                                @elseif ($item['status'] == 'ended') Berakhir
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('campus-info.show', $item['id']) }}" style="cursor: pointer;" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </a>
                                                @if ($item['created_by'] === session('auth.user.id'))
                                                    <a href="{{ route('campus-info.edit', $item['id']) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            Info Kampus tidak ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- @if (count($products) >= $limitData)
                            <div class="mt-3">
                                <button type="button" class="btn btn-primary" wire:click="addLimitData()" wire:loading.attr="disabled" wire:target="addLimitData()">
                                    Lihat lebih banyak
                                </button>
                            </div>
                        @endif --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
