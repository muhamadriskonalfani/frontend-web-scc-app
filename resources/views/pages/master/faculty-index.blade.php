@extends('layouts.app')

@section('title', 'Master Fakultas')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/master/faculties/index') }}">Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Fakultas</li>
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
                            <div class="d-flex justify-content-start align-items-center pt-2 pe-2">
                                <h4>Daftar Fakultas</h4>
                                <div>
                                    <a href="{{ route('master.faculties.create') }}" class="btn btn-primary">
                                        Tambah
                                    </a>
                                </div>
                            </div>
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
                                    id="input-search" placeholder="Nama / Kode" 
                                    value="{{ $search }}">
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" style="width: 20px;">No</th>
                                    <th scope="col" class="text-start">Nama Fakultas</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($faculties as $faculty)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start text-wrap">{{ $faculty['name'] }}</td>
                                        <td>{{ $faculty['code'] }}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="action-btns">
                                                <a href="{{ route('master.faculties.edit', $faculty['id']) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a>
                                            </div>
                                            <div class="action-btns">
                                                <form method="POST" action="{{ route('master.faculties.destroy', $faculty['id']) }}" 
                                                    onsubmit="return confirm('Yakin ingin menghapus fakultas ini?')">
                                                    @csrf
                                                    @method('DELETE')
    
                                                    <button class="border-0 bg-transparent action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Data fakultas kosong
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
