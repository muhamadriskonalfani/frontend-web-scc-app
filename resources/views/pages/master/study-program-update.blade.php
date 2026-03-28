@extends('layouts.app')

@section('title', 'Edit Program Studi')

@section('content')
<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/master/faculties/index">Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Program Studi</li>
            </ol>
        </nav>
    </div>

    <div class="col-lg-12 layout-spacing layout-top-spacing">

        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area border-0">

                <!-- Error Message -->
                @if ($errors->has('message'))
                    <div class="alert alert-danger">
                        {{ $errors->first('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('master.study-programs.update', $studyProgram['id']) }}">
                    @csrf
                    @method('PUT')
                    
                    <p class="fs-5 mb-3 fw-semibold">Edit Program Studi</p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Program Studi</label>
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ $studyProgram['name'] }}"
                                    placeholder="..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kode Program Studi</label>
                                <input type="text"
                                    name="code"
                                    class="form-control"
                                    value="{{ $studyProgram['code'] }}"
                                    placeholder="..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fakultas</label>
                                <select name="faculty_id" class="form-select" required>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty['id'] }}"
                                            {{ $studyProgram['faculty_id'] == $faculty['id'] ? 'selected' : '' }}>
                                            {{ $faculty['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenjang</label>
                                <select name="degree" class="form-select" required>
                                    @foreach (['D3','D4','S1','S2','S3'] as $degree)
                                        <option value="{{ $degree }}"
                                            {{ $studyProgram['degree'] == $degree ? 'selected' : '' }}>
                                            {{ $degree }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="mt-3 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary me-2" style="width: 100px;">
                            Perbarui
                        </button>
                        <a href="{{ route('master.study-programs.index') }}" class="btn btn-primary">
                            Kembali
                        </a>
                    </div>

                </form>
                
            </div>
        </div>
    </div>

</div>
@endsection
