@extends('layouts.app')

@section('title', 'Detail Admin')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admins/index') }}">Kelola Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Admin</li>
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
                            <h4>Detail Admin Fakultas</h4>
                        </div>
                    </div>
                </div>

                <!-- ISI HALAMAN -->
                <div class="widget-content widget-content-area border-0">

                    <div class="mb-4">
                        <table class="table table-sm">
                            <tr>
                                <th width="200">Nama</th>
                                <td>{{ $admin['name'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $admin['email'] }}</td>
                            </tr>
                            <tr>
                                <th>Fakultas</th>
                                <td>{{ $admin['admin_profile']['faculty']['name'] ?? '-'}}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $admin['admin_profile']['position'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>NIDN/NUPTK</th>
                                <td>{{ $admin['admin_profile']['nip'] ?? '-' }}</td>
                            </tr>
                            {{-- <tr>
                                <th>Peran</th>
                                <td>{{ ucfirst($admin['role']) }}</td>
                            </tr> --}}
                            <tr>
                                <th>Status Pengguna</th>
                                <td>
                                    @if ($admin['status'] === 'pending') Menunggu
                                    @elseif ($admin['status'] === 'active') Aktif
                                    @elseif ($admin['status'] === 'rejected') Ditolak
                                    @elseif ($admin['status'] === 'banned') Diblokir
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <div class="">
                            <a href="{{ route('admins.edit', $admin['id']) }}" class="btn btn-primary" style="width: 100px;">
                                Edit
                            </a>
                        </div>
                        <div class="">
                            <a href="{{ route('admins.index') }}" class="btn btn-primary">
                                Kembali
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection
