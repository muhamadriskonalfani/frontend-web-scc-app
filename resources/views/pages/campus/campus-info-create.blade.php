@extends('layouts.app')

@section('title', 'Tambah Informasi Kampus')

@section('content')
<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admins/index">Info Kampus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Informasi Kampus</li>
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

                <form method="POST" action="{{ route('campus-info.store') }}" enctype="multipart/form-data">
                    @csrf

                    <p class="fs-5 mb-4 fw-semibold">Tambah Informasi Kampus</p>

                    <div class="row">

                        <!-- LEFT: INPUT -->
                        <div class="col-md-7">

                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="title" class="form-control" placeholder="Masukkan judul..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="Tulis deskripsi..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Gambar (opsional)</label>
                                <input 
                                    type="file" 
                                    name="image" 
                                    class="form-control"
                                    accept="image/*"
                                    id="imageInput"
                                >
                            </div>

                        </div>

                        <!-- RIGHT: PREVIEW -->
                        <div class="col-md-5">

                            <label class="form-label">Preview Gambar</label>

                            <div class="rounded p-3 d-flex flex-column align-items-center bg-light" style="min-height: 250px;">

                                <img id="preview" 
                                    class="img-fluid rounded shadow-sm"
                                    style="max-height: 200px; display:none;">

                                <p id="emptyText" class="text-muted mt-3">
                                    Belum ada gambar
                                </p>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Tambahkan
                        </button>
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
