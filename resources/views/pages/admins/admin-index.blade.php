@extends('layouts.app')

@section('title', 'Daftar Admin Fakultas')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admins/index') }}">Kelola Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Admin</li>
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
                            <h4>Daftar Admin Fakultas</h4>
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
                                    id="input-search" placeholder="Nama / Email" 
                                    value="{{ $search }}">
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col" class="text-start">Nama</th>
                                    <th scope="col" class="text-start">Email</th>
                                    <th scope="col" class="text-start">Fakultas</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
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

                                @forelse ($admins['data'] as $index => $admin)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start text-wrap">{{ $admin['name'] }}</td>
                                        <td class="text-start text-wrap">{{ $admin['email'] }}</td>
                                        <td class="text-start text-wrap">
                                            {{ $admin['admin_profile']['faculty']['name'] ?? '-' }}
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusClasses[$admin['status']] ?? 'badge-light-secondary' }}" style="width: 90px;">
                                                @if ($admin['status'] == 'pending') Menunggu
                                                @elseif ($admin['status'] == 'active') Aktif
                                                @elseif ($admin['status'] == 'rejected') Ditolak
                                                @elseif ($admin['status'] == 'banned') Diblokir
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('admins.show', $admin['id']) }}" style="cursor: pointer;" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </a>
                                                <a href="{{ route('admins.edit', $admin['id']) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Data admin belum tersedia
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
