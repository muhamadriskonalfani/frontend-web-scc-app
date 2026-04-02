@extends('layouts.app')

@section('title', 'Edit Fakultas')

@section('content')
<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/master/faculties/index">Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Fakultas</li>
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

                <form method="POST" action="{{ route('master.faculties.update', $faculty['id']) }}">
                    @csrf
                    @method('PUT')
                    
                    <p class="fs-5 mb-3 fw-semibold">Ubah Fakultas</p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Program Studi</label>
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ $faculty['name'] }}"
                                    placeholder="..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kode Program Studi</label>
                                <input type="text"
                                    name="code"
                                    class="form-control"
                                    value="{{ $faculty['code'] }}"
                                    placeholder="..." required>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="mt-3 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary me-2" style="width: 100px;">
                            Perbarui
                        </button>
                        <a href="{{ route('master.faculties.index') }}" class="btn btn-primary">
                            Kembali
                        </a>
                    </div>

                </form>
                
            </div>
        </div>
    </div>

</div>
@endsection
