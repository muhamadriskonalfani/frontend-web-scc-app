@extends('layouts.auth')

@section('title', 'Admin Login')

@section('styles')
<style>
    .container-fluid {
        position: relative;
        background-image: url('./assets/src/assets/img/bg_1.png');
        background-size: contain;
        background-position: top left;
    }

    .auth-left-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 60px;
    }

    .auth-right {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-right .box-radius {
        width: 100%;
        height: 600px;
        max-width: 500px;
        padding: 30px 50px; 
        border-radius: 20px; 
        background: #ffffff;
        box-shadow: 
            0 25px 60px rgba(0,0,0,0.25),
            0 10px 25px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.4);
    }

    /* LOGIN CARD */
    .login-card {
        width: 100%;
        height: 100%;
        margin-top: 150px;
    }

    .login-card h3{
        font-size: 30px;
        font-weight: 700;
        color: #1f2937;
        letter-spacing: .3px;
        margin-bottom: 8px; 
    }

    .login-card p{
        color: #6b7280;
        font-size: 15px;
    }

    /* INPUT STYLE */
    .input-group{
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #d1d5db;
        transition: all .2s ease;
        background: #fff;
    }

    .input-group:hover{
        border-color: #94a3b8;
    }

    .input-group:focus-within{
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }

    /* ICON */
    .input-group-text{
        background: #f8fafc;
        border: none;
        color: #64748b;
        padding-left: 14px;
    }

    /* INPUT */
    .form-control{
        border: none;
        padding: 12px 14px;
        font-size: 15px;
        color: #1f2937;
        box-shadow: none !important;
    }

    .form-control::placeholder{
        color: #94a3b8;
    }

    /* LABEL */
    .form-label{
        font-weight: 600;
        font-size: 14px;
        color: #334155;
        margin-bottom: 6px;
    }

    /* REMEMBER CHECKBOX */
    .form-check-label{
        font-size: 14px;
        color: #64748b;
    }

    /* BUTTON LOGIN */
    .btn-primary{
        background: linear-gradient(135deg,#6366f1,#3b82f6); 
        border: none;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: .3px;
        transition: all .2s ease;
        color: #fff;
        padding: 12px;
    }

    .btn-primary:hover{
        transform: translateY(-1px);
        background: linear-gradient(135deg,#3b82f6,#6366f1);
        box-shadow: 0 8px 18px rgba(0,0,0,0.12);
    }

    /* ALERT */
    .alert{
        border-radius: 8px;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="row g-0 h-100">

    <!-- LEFT IMAGE -->
    <div class="col-md-6 d-none d-md-flex auth-left align-items-center" style="height: 100vh;">
        <div class="auth-left-content d-none">
            <h1 class="fw-bold mb-3">SCC Admin Panel</h1>
            <p class="fs-5 opacity-75">
                Sistem manajemen administrasi untuk mengelola data dan informasi aplikasi.
            </p>
        </div>
    </div>

    <!-- RIGHT FORM -->
    <div class="col-md-6 auth-right bg-white">
        <div class="d-flex align-items-center justify-content-center box-radius">
            <div class="login-card">
                <h3 class="fw-bold mb-2">Login Admin</h3>
                <p class="text-muted mb-4">
                    Masukkan email dan password Anda
                </p>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i data-feather="mail"></i>
                            </span>
                            <input type="email" name="email" class="form-control" 
                                placeholder="admin@email.com" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i data-feather="lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" 
                                placeholder="********" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 d-none">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        Login
                    </button>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
