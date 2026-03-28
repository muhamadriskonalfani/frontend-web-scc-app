@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admins/index">Kelola Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
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

                <form method="POST" action="{{ route('admins.store') }}">
                    @csrf
                    
                    <p class="fs-5 mb-3 fw-semibold">Tambah Admin Fakultas</p>

                    <div class="row">

                        {{-- Nama --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nama Admin</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name') }}" placeholder="..." required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email') }}" placeholder="..." required>
                        </div>

                        {{-- Faculty --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fakultas</label>
                            <select name="faculty_id" class="form-select" required>
                                <option value="">-- Pilih Fakultas --</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty['id'] }}">
                                        {{ $faculty['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" 
                                class="form-control" placeholder="..." required>
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control" placeholder="..." required>
                        </div>

                        {{-- NIP --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">NIDN/NUPTK (Opsional)</label>
                            <input type="text" name="nip" class="form-control"
                                value="{{ old('nip') }}" placeholder="...">
                        </div>

                        {{-- Position --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="position" class="form-control"
                                value="{{ old('position') }}" placeholder="...">
                        </div>

                    </div>

                    <hr>
                    <div class="mt-3 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary me-2">
                            Tambahkan
                        </button>
                        {{-- <a href="{{ route('dashboard.index') }}" class="btn btn-danger me-2">
                            Batal
                        </a> --}}
                    </div>

                </form>
                
            </div>
        </div>
    </div>

</div>
@endsection
