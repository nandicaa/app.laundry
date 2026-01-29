@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center text-lg-start py-5 mb-5" style="background: linear-gradient(to bottom, #dbe4ff, #f8f9fa); border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; margin-top: -24px; padding-top: 80px !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm mb-3 border fw-bold text-uppercase tracking-wider">✨ Solusi Laundry Cerdas</span>
                <h1 class="display-4 fw-bold mb-3 lh-sm" style="color: #2b2d42;">
                    P pakaian Bersih,<br>
                    <span class="text-primary">Hidup Lebih Santai.</span>
                </h1>
                <p class="lead text-muted mb-4 opacity-75">
                    Layanan laundry premium dengan harga bersahabat. Kami menjamin pakaian Anda bersih, wangi, dan rapi dalam waktu singkat.
                </p>
                @guest
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-lg fw-bold">Daftar Sekarang</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5 fw-bold">Masuk</a>
                    </div>
                @else
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow fw-bold">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                        </a>
                    @else
                        <div class="alert alert-light border-0 shadow-sm d-inline-block rounded-4 px-4 py-3">
                            <h5 class="mb-1 fw-bold text-primary">👋 Halo, {{ Auth::user()->name }}!</h5>
                            <p class="mb-0 text-muted small">Gulir ke bawah untuk memilih layanan.</p>
                        </div>
                    @endif
                @endguest
            </div>
            <div class="col-lg-6 text-center">
                 <img src="https://img.freepik.com/free-vector/laundry-concept-illustration_114360-1282.jpg" class="img-fluid rounded-4 shadow-lg" alt="Laundry Illustration" style="max-height: 400px; transform: rotate(-2deg);">
            </div>
        </div>
    </div>
</section>

<!-- Active Orders Section (Customer Only) -->
@if(Auth::check() && Auth::user()->role === 'customer')
<section class="container mb-5" id="user-dashboard">
    <div class="row mb-4">
        <!-- Stats Cards -->
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm bg-primary text-white h-100 rounded-4 overflow-hidden position-relative">
                <div class="card-body p-4 position-relative z-1">
                    <h5 class="mb-3 fw-normal opacity-75">Pesanan Aktif</h5>
                    <h2 class="fw-bold display-4 mb-0">{{ $stats['active'] ?? 0 }}</h2>
                </div>
                <i class="bi bi-basket position-absolute bottom-0 end-0 opacity-25" style="font-size: 8rem; margin: -20px -20px 0 0;"></i>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm bg-success text-white h-100 rounded-4 overflow-hidden position-relative">
                <div class="card-body p-4 position-relative z-1">
                    <h5 class="mb-3 fw-normal opacity-75">Selesai</h5>
                    <h2 class="fw-bold display-4 mb-0">{{ $stats['completed'] ?? 0 }}</h2>
                </div>
                <i class="bi bi-check2-circle position-absolute bottom-0 end-0 opacity-25" style="font-size: 8rem; margin: -20px -20px 0 0;"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white h-100 rounded-4 overflow-hidden position-relative">
                <div class="card-body p-4 position-relative z-1">
                    <h5 class="mb-3 fw-normal opacity-75">Total Pengeluaran</h5>
                    <h2 class="fw-bold display-6 mb-0">Rp {{ number_format($stats['expense'] ?? 0, 0, ',', '.') }}</h2>
                </div>
                <i class="bi bi-wallet2 position-absolute bottom-0 end-0 opacity-25" style="font-size: 8rem; margin: -20px -20px 0 0;"></i>
            </div>
        </div>
    </div>

    @if(isset($myOrders) && count($myOrders) > 0)
    <div class="d-flex align-items-center mb-4 mt-5">
        <h3 class="fw-bold text-dark m-0"><i class="bi bi-clock-history text-primary me-2"></i>Riwayat Pesanan</h3>
    </div>
    <div class="row g-4">
        @foreach($myOrders as $order)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 position-relative overflow-hidden hover-card">
                    <div class="position-absolute start-0 top-0 h-100" style="width: 5px; background: {{ match($order->status) { 'pending' => '#6c757d', 'diproses' => '#ffc107', 'siap ambil' => '#0dcaf0', 'selesai' => '#198754', default => '#f8f9fa' } }};"></div>
                    <div class="card-body ps-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge {{ match($order->status) { 'pending' => 'bg-secondary', 'diproses' => 'bg-warning text-dark', 'siap ambil' => 'bg-info text-dark', 'selesai' => 'bg-success', default => 'bg-light' } }} rounded-pill px-3 py-2">
                                {{ strtoupper($order->status) }}
                            </span>
                            <small class="text-secondary fw-medium"><i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('d M, H:i') }}</small>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $order->jenis }}</h5>
                        <p class="text-muted small mb-3 text-uppercase tracking-wide">ID: #{{ $order->id }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light">
                            <span class="text-secondary small">Total Biaya</span>
                            <span class="fw-bold text-primary fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486777.png" alt="Empty" style="width: 150px; opacity: 0.5;">
        <h4 class="text-muted mt-3">Belum ada riwayat pesanan</h4>
        <p class="text-secondary">Yuk pesan layanan laundry pertamamu!</p>
    </div>
    @endif
</section>
@endif

<!-- Services Section -->
<section class="container mb-5">
    <div class="text-center mb-5">
        <h6 class="text-uppercase text-primary fw-bold tracking-wider">Layanan Kami</h6>
        <h2 class="fw-bold display-6">Pilih Paket Sesuai Kebutuhan</h2>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-4">
            <div class="card h-100 shadow border-0 product-card" style="transition: all 0.3s;">
                <div class="position-relative">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x400/e9ecef/495057?text='.urlencode($product->name) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <div class="position-absolute bottom-0 end-0 bg-white px-3 py-1 m-3 rounded-pill shadow-sm fw-bold text-primary">
                        {{ $product->type == 'kiloan' ? '/ Kg' : '/ Pcs' }}
                    </div>
                </div>
                <div class="card-body p-4 text-center">
                    <h4 class="card-title fw-bold mb-3">{{ $product->name }}</h4>
                    <p class="card-text text-muted mb-4">{{ Str::limit($product->description, 100) }}</p>
                    <h3 class="fw-bold text-dark mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                    
                    @auth
                        <button type="button" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $product->id }}">
                            <i class="bi bi-bag-plus me-2"></i>Pesan Sekarang
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 py-2 rounded-3 fw-bold">Login untuk Pesan</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Modal for each product (Required for Logic) -->
        @auth
        <div class="modal fade" id="orderModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('order.store') }}" method="POST" class="modal-content border-0 shadow-lg rounded-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="modal-header border-0 bg-primary text-white rounded-top-4">
                        <h5 class="modal-title fw-bold"><i class="bi bi-cart-plus-fill me-2"></i>Pesan {{ $product->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="alert alert-light border-start border-4 border-primary mb-4 p-3 shadow-sm rounded-0">
                            <strong>Info:</strong> Pesanan Anda akan kami hitung ulang berat/jumlah pastinya saat penjemputan atau di outlet.
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Perkiraan Jumlah ({{ $product->type == 'kiloan' ? 'Kg' : 'Pcs' }})</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-box-seam"></i></span>
                                <input type="number" name="qty" class="form-control border-start-0 ps-0" required min="1" value="1" style="box-shadow: none;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Khusus</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Contoh: Tolong dipisah pakaian putih..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 px-4 pb-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow">Kirim Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
        @endauth

        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted fs-5">Belum ada layanan yang tersedia saat ini.</div>
        </div>
        @endforelse
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background-color: #f0f4f8; border-radius: 50px; margin-bottom: -50px; padding-bottom: 100px !important;">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-uppercase text-primary fw-bold tracking-wider">Testimoni</h6>
            <h2 class="fw-bold">Kata Mereka Tentang Kami</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 p-4 h-100 shadow-sm rounded-4 text-center">
                    <div class="mb-3 text-warning fs-5">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="mb-4 text-muted fst-italic">"Sangat membantu buat saya yang sibuk kerja. Hasilnya bersih banget dan wanginya tahan lama!"</p>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">B</div>
                        <div class="text-start">
                            <h6 class="fw-bold mb-0">Budi Santoso</h6>
                            <small class="text-muted">Karyawan Swasta</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 p-4 h-100 shadow-sm rounded-4 text-center">
                    <div class="mb-3 text-warning fs-5">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                    </div>
                    <p class="mb-4 text-muted fst-italic">"Harga mahasiswa tapi kualitas hotel bintang lima. Jempol banget buat CleanSpark!"</p>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">S</div>
                        <div class="text-start">
                            <h6 class="fw-bold mb-0">Siti Aminah</h6>
                            <small class="text-muted">Mahasiswi</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 p-4 h-100 shadow-sm rounded-4 text-center">
                    <div class="mb-3 text-warning fs-5">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="mb-4 text-muted fst-italic">"Pelayanan ramah dan on-time. Suka fitur tracking pesanannya, jadi ga was-was."</p>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">R</div>
                        <div class="text-start">
                            <h6 class="fw-bold mb-0">Rian Hidayat</h6>
                            <small class="text-muted">Wiraswasta</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .product-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
