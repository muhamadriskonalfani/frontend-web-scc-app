@extends('layouts.app')

@section('title', 'Tracer Study')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/users/index') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna</li>
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
                            <h4>Daftar Pengguna</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area border-0 pt-2">

                    <!-- DAFTAR FILTER -->
                    <div class="d-flex justify-content-start align-items-end mb-3">
                        <div class="">
                            <form method="GET" class="d-flex align-items-end gap-2">

                                <div class="row">
                                    <div class="col-md-4">
                                        {{-- SEARCH --}}
                                        <div class="mb-3">
                                            <label class="form-label">Pencarian</label>
                                            <input type="text"
                                                name="search"
                                                value="{{ request('search') }}"
                                                class="form-control py-2"
                                                placeholder="Nama / Email / NIM">
                                        </div>

                                        {{-- TIPE --}}
                                        <div class="">
                                            <label class="form-label">Tipe</label>
                                            <select name="type" class="form-select py-2">
                                                <option value="">-- Semua --</option>
                                                <option value="alumni" 
                                                    {{ request('type') == 'alumni' ? 'selected' : '' }}>
                                                    Alumni
                                                </option>
                                                <option value="student" 
                                                    {{ request('type') == 'student' ? 'selected' : '' }}>
                                                    Mahasiswa
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        {{-- FAKULTAS --}}
                                        <div class="mb-3">
                                            <label class="form-label">Fakultas</label>
                                            <select name="faculty_id" class="form-select py-2">
                                                <option value="">Semua Fakultas</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty['id'] }}"
                                                        {{ request('faculty_id') == $faculty['id'] ? 'selected' : '' }}>
                                                        {{ $faculty['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- PRODI --}}
                                        <div class="">
                                            <label class="form-label">Program Studi</label>
                                            <select name="study_program_id" class="form-select py-2">
                                                <option value="">Semua Prodi</option>
                                                @foreach ($studyPrograms as $prodi)
                                                    <option value="{{ $prodi['id'] }}"
                                                        {{ request('study_program_id') == $prodi['id'] ? 'selected' : '' }}>
                                                        {{ $prodi['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        {{-- RANGE ANGKATAN --}}
                                        <div class="mb-3">
                                            <label class="form-label">Angkatan Dari</label>
                                            <input type="number"
                                                name="entry_year_from"
                                                value="{{ request('entry_year_from') }}"
                                                class="form-control py-2"
                                                placeholder="...">
                                        </div>

                                        <div class="">
                                            <label class="form-label">Angkatan Sampai</label>
                                            <input type="number"
                                                name="entry_year_to"
                                                value="{{ request('entry_year_to') }}"
                                                class="form-control py-2"
                                                placeholder="...">
                                        </div>
                                    </div>
                                </div>

                                {{-- BUTTON --}}
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary py-2">
                                        Filter
                                    </button>

                                    <a href="{{ route('users.index') }}"
                                    class="btn btn-primary py-2">
                                        Reset
                                    </a>
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
                                    <th class="text-start">Fakultas</th>
                                    <th class="text-start">Prodi</th>
                                    <th>Tipe</th>
                                    <th>NIM</th>
                                    <th>Angkatan</th>
                                    <th style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $roleClasses = [
                                        'student'   => 'badge-light-warning',
                                        'alumni'    => 'badge-light-primary',
                                    ];
                                @endphp

                                @forelse ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start text-wrap">{{ $item['name'] ?? '-' }}</td>
                                        <td class="text-start text-wrap">{{ $item['tracer_study']['faculty']['name'] ?? '-' }}</td>
                                        <td class="text-start text-wrap">{{ $item['tracer_study']['study_program']['name'] ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $roleClasses[$item['role']] ?? 'badge-light-secondary' }}" style="width: 90px;">
                                                @if ($item['role'] == 'alumni') Alumni
                                                @elseif ($item['role'] == 'student') Mahasiswa
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ $item['tracer_study']['student_id_number'] ?? '-' }}</td>
                                        <td>{{ $item['tracer_study']['entry_year'] ?? '-' }}</td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('users.show', $item['id']) }}" style="cursor: pointer;" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-3">
                                            Data tidak ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- PAGINATION --}}
                {{-- @if(isset($pagination['links']))
                    <nav>
                        <ul class="pagination justify-content-center">

                            @foreach ($pagination['links'] as $link)
                                <li class="page-item {{ $link['active'] ? 'active' : '' }} {{ !$link['url'] ? 'disabled' : '' }}">
                                    <a class="page-link"
                                    href="{{ $link['url'] ?? '#' }}"
                                    {!! $link['url'] ? '' : 'tabindex="-1" aria-disabled="true"' !!}>
                                        {!! $link['label'] !!}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </nav>
                @endif --}}

            </div>
        </div>

    </div>
</div>
@endsection
