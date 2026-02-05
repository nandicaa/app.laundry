@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-5" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h1 class="fw-bold text-success mb-2">Buat Akun Baru</h1>
                    <p class="text-muted">Bergabunglah dengan Laundry Ibu hari ini</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-4 mb-4" role="alert">
                        <div class="fw-bold mb-2">Perbaiki kesalahan berikut:</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" class="form-control bg-light border-start-0 ps-0 @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                        </div>
                        @error('name')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-start-0 ps-0 @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-start-0 ps-0 @error('password') is-invalid @enderror" placeholder="******" required>
                            </div>
                            @error('password')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-start-0 ps-0 @error('password_confirmation') is-invalid @enderror" placeholder="******" required>
                            </div>
                            @error('password_confirmation')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm fw-bold">DAFTAR SEKARANG</button>
                    </div>
                    <div class="text-center">
                        <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Login disini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
