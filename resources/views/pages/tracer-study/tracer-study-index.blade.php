@extends('layouts.app')

@section('title', 'Tracer Study')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/tracer-study/index') }}">Tracer Study</a></li>
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
                            <h4>Daftar Tracer Study</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area border-0 pt-2">

                    <!-- DAFTAR FILTER -->
                    <div class="d-flex justify-content-start align-items-end mb-3">
                        <div class="">
                            <form method="GET" class="d-flex align-items-end gap-2">

                                {{-- SEARCH --}}
                                <div class="">
                                    <label class="form-label">Pencarian</label>
                                    <input type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="form-control py-2"
                                        placeholder="Nama / Email / NIM">
                                </div>

                                {{-- FAKULTAS --}}
                                {{-- <div class="">
                                    <label class="form-label">Fakultas</label>
                                    <select name="faculty_id" class="form-select">
                                        <option value="">Semua Fakultas</option>
                                        @foreach ($faculties as $faculty)
                                            <option value="{{ $faculty['id'] }}"
                                                {{ request('faculty_id') == $faculty['id'] ? 'selected' : '' }}>
                                                {{ $faculty['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

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

                                {{-- RANGE ANGKATAN --}}
                                <div class="">
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

                                {{-- BUTTON --}}
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary py-2">
                                        Filter
                                    </button>

                                    <a href="{{ route('tracer-study.index') }}"
                                    class="btn btn-primary py-2">
                                        Reset
                                    </a>

                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary dropdown-toggle py-2" data-bs-toggle="dropdown">
                                            Cetak
                                        </button>

                                        <div class="dropdown-menu">

                                            {{-- EXCEL --}}
                                            <a href="{{ route('tracer-study.export', array_merge(
                                                    request()->only([
                                                        'search',
                                                        'faculty_id',
                                                        'study_program_id',
                                                        'entry_year_from',
                                                        'entry_year_to'
                                                    ]),
                                                    ['type' => 'excel']
                                                )) }}"
                                                class="dropdown-item">
                                                <i class="flaticon-file-1 mr-1"></i>
                                                Excel
                                            </a>

                                            {{-- PDF --}}
                                            <a href="{{ route('tracer-study.export', array_merge(
                                                    request()->only([
                                                        'search',
                                                        'faculty_id',
                                                        'study_program_id',
                                                        'entry_year_from',
                                                        'entry_year_to'
                                                    ]),
                                                    ['type' => 'pdf']
                                                )) }}"
                                                class="dropdown-item">
                                                <i class="flaticon-file-2 mr-1"></i>
                                                PDF
                                            </a>

                                        </div>
                                    </div>
                                    
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
                                    <th class="text-start">NIM</th>
                                    <th class="text-start">Fakultas</th>
                                    <th class="text-start">Prodi</th>
                                    <th>Angkatan</th>
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

                                @forelse ($tracerStudies as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start text-wrap">{{ $item['user']['name'] ?? '-' }}</td>
                                        <td class="text-start text-wrap">{{ $item['student_id_number'] ?? '-' }}</td>
                                        <td class="text-start text-wrap">{{ $item['faculty']['name'] ?? '-' }}</td>
                                        <td class="text-start text-wrap">{{ $item['study_program']['name'] ?? '-' }}</td>
                                        <td>{{ $item['entry_year'] }}</td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('tracer-study.show', $item['id']) }}" style="cursor: pointer;" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Detail">
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
