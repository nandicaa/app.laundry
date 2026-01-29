@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-5" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h1 class="fw-bold text-primary mb-2"><i class="bi bi-water me-2"></i>Laundry Ibu</h1>
                    <p class="text-muted">Masuk untuk mengelola pesanan Anda</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 small">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-start-0 ps-0" placeholder="nama@email.com" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control bg-light border-start-0 ps-0" placeholder="******" required>
                        </div>
                    </div>
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-bold">MASUK</button>
                    </div>
                    <div class="text-center">
                        <small class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Daftar sekarang</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
