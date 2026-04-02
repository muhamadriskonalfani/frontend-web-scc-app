@extends('layouts.app')

@section('title', 'Input Pengguna')

@section('content')
<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/users/index') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Pengguna</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="col-lg-12 layout-spacing layout-top-spacing">

        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area border-0">

                @if ($errors->has('message'))
                    <div class="alert alert-danger">
                        {{ $errors->first('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <p class="fs-5 mb-4 fw-semibold">Input Pengguna</p>

                    <div class="row">

                        {{-- NAME --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name"
                                class="form-control"
                                value="{{ old('name') }}" placeholder="..." required>
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control"
                                value="{{ old('email') }}" placeholder="..." required>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control" placeholder="..." required>
                        </div>

                        {{-- ROLE --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="student">Mahasiswa</option>
                                <option value="alumni">Alumni</option>
                            </select>
                        </div>

                        {{-- NIM --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text"
                                name="student_id_number"
                                class="form-control"
                                value="{{ old('student_id_number') }}"
                                placeholder="..." required>
                        </div>

                        {{-- GENDER --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select" required>
                                <option value="">-- Pilih Gender --</option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>

                        {{-- FACULTY --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fakultas</label>
                            <select id="faculty_id" name="faculty_id"
                                class="form-select" required>

                                <option value="">-- Pilih Fakultas --</option>

                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty['id'] }}">
                                        {{ $faculty['name'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- STUDY PROGRAM --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Program Studi</label>
                            <select id="study_program_id"
                                name="study_program_id"
                                class="form-select" required>

                                <option value="">
                                    -- Pilih Program Studi --
                                </option>

                            </select>
                        </div>

                        {{-- ENTRY YEAR --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tahun Masuk</label>
                            <input type="number"
                                name="entry_year"
                                class="form-control"
                                value="{{ old('entry_year') }}"
                                placeholder="2020"
                                placeholder="..." required>
                        </div>

                        {{-- GRADUATION YEAR --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                Tahun Lulus (Opsional)
                            </label>
                            <input type="number"
                                name="graduation_year"
                                class="form-control"
                                value="{{ old('graduation_year') }}"
                                placeholder="...">
                        </div>

                    </div>

                    <hr>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            Tambahkan
                        </button>

                        <a href="{{ route('users.index') }}"
                            class="btn btn-primary">
                            Lihat Daftar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>

        const studyPrograms = @json($studyPrograms);

        const facultySelect = document.getElementById('faculty_id');
        const studyProgramSelect = document.getElementById('study_program_id');

        facultySelect.addEventListener('change', function () {

            const facultyId = this.value;

            studyProgramSelect.innerHTML =
                '<option value="">-- Pilih Program Studi --</option>';

            const filtered = studyPrograms.filter(function (sp) {
                return sp.faculty_id == facultyId;
            });

            filtered.forEach(function (sp) {

                const option = document.createElement('option');

                option.value = sp.id;
                option.text = sp.name;

                studyProgramSelect.appendChild(option);

            });

        });

    </script>

</div>
@endsection
