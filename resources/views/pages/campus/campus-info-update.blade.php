@extends('layouts.app')

@section('title', 'Edit Informasi Kampus')

@section('content')
<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admins/index">Info Kampus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Informasi Kampus</li>
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

                <form method="POST" action="{{ route('campus-info.update', $campusInfo['id']) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <p class="fs-5 mb-4 fw-semibold">Ubah Informasi Kampus</p>

                    <div class="row">

                        <!-- LEFT: INPUT -->
                        <div class="col-md-7">

                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="title"
                                    class="form-control"
                                    value="{{ $campusInfo['title'] }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description"
                                        class="form-control"
                                        rows="5"
                                        required>{{ $campusInfo['description'] }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ganti Gambar (opsional)</label>
                                <input 
                                    type="file" 
                                    name="image" 
                                    class="form-control"
                                    accept="image/*"
                                    id="imageInput"
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" {{ $campusInfo['status'] === 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="ended" {{ $campusInfo['status'] === 'ended' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>

                        </div>

                        <!-- RIGHT: PREVIEW -->
                        <div class="col-md-5">

                            <label class="form-label fw-semibold">Preview Gambar</label>

                            <div class="bg-light rounded p-3">

                                <!-- Gambar lama -->
                                <div class="mb-3 text-center">
                                    @if($campusInfo['image_url'])
                                        <img id="oldImage"
                                            src="{{ $campusInfo['image_url'] }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 180px;">

                                        <small class="text-muted d-block mt-3">Gambar Saat Ini</small>
                                    @else
                                        <p class="text-muted">Belum ada gambar</p>
                                    @endif
                                </div>

                                <hr class="mt-1">

                                <!-- Preview gambar baru -->
                                <div class="d-flex flex-column align-items-center">
                                    <img id="preview" 
                                        class="img-fluid rounded shadow-sm"
                                        style="max-height: 180px; display:none;">

                                    <small class="text-muted d-block mt-3">Preview Gambar Baru</small>

                                    <p id="emptyText" class="text-muted">
                                        Belum ada gambar baru
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Perbarui
                        </button>

                        <a href="{{ route('campus-info.index') }}" class="btn btn-light ms-2">
                            Kembali
                        </a>
                    </div>

                </form>
                
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(e){
            const file = e.target.files[0];

            if (file) {
                const preview = document.getElementById('preview');
                const emptyText = document.getElementById('emptyText');

                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';

                if (emptyText) emptyText.style.display = 'none';
            }
        });
    </script>

</div>
@endsection
