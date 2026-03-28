@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admins/index">Kelola Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Admin</li>
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

                <form method="POST" action="{{ route('admins.update', $admin['id']) }}">
                    @csrf
                    @method('PUT')

                    <p class="fs-5 mb-3 fw-semibold">Ubah Admin Fakultas</p>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $admin['name']) }}" placeholder="..." required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $admin['email']) }}" placeholder="..." required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fakultas ID</label>
                            <select name="faculty_id" class="form-select">
                                <option value="">-- Pilih Fakultas --</option>
                                @foreach($faculties as $faculty)
                                    <option 
                                        value="{{ $faculty['id'] }}"
                                        {{ $admin['admin_profile']['faculty_id'] == $faculty['id'] ? 'selected' : '' }}
                                    >
                                        {{ $faculty['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">NIDN/NUPTK</label>
                            <input type="text" name="nip" class="form-control"
                                value="{{ old('nip', $admin['admin_profile']['nip'] ?? '') }}" placeholder="...">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="position" class="form-control"
                                value="{{ old('position', $admin['admin_profile']['position'] ?? '') }}" placeholder="...">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $admin['status'] === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="banned" {{ $admin['status'] === 'banned' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Password Baru (opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="...">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="...">
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-start gap-2">
                        <button class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
