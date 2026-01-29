<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Ibu - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --light-bg: #f8f9fa;
        }
        body { 
            background-color: var(--light-bg); 
            font-family: 'Poppins', sans-serif; 
            color: #333;
        }
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95) !important;
        }
        .nav-link {
            color: #555 !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }
        .dropdown-item:active {
            background-color: var(--primary-color);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .fw-bold { font-weight: 700 !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="{{ url('/') }}">
                <i class="bi bi-water me-2"></i>Laundry Ibu
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('products*') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/products') }}">Kelola Layanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard*') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav align-items-center gap-2">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="fw-semibold">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2 p-2">
                                <li>
                                    <div class="px-3 py-2">
                                        <small class="text-uppercase text-muted" style="font-size: 0.7rem;">Role</small>
                                        <div class="fw-bold text-primary">{{ ucfirst(Auth::user()->role) }}</div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item rounded-3" href="{{ url('/dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item rounded-3" href="{{ url('/#user-dashboard') }}"><i class="bi bi-clock-history me-2"></i>Pesanan Saya</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item rounded-3 text-danger" href="{{ route('logout') }}">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
