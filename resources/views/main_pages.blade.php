@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard Admin</h2>
        <p class="text-muted">Pantau aktivitas laundry Anda hari ini</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary shadow-sm rounded-3 fw-bold">
            <i class="bi bi-tags me-1"></i> Kelola Layanan
        </a>
        <button class="btn btn-primary shadow-lg rounded-3 fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle me-1"></i> Transaksi Baru
        </button>
    </div>
</div>

<div class="row g-3 mb-5">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 rounded-4" style="background: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%); color: white;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <i class="bi bi-basket fs-3 opacity-50"></i>
                <span class="badge bg-white text-primary rounded-pill">Total</span>
            </div>
            <h2 class="mb-0 fw-bold display-5">{{ $total_pesanan }}</h2>
            <p class="mb-0 small opacity-75">Pesanan Masuk</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 rounded-4 bg-warning text-dark" style="background: linear-gradient(135deg, #ffd60a 0%, #ffc300 100%);">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <i class="bi bi-arrow-repeat fs-3 opacity-50"></i>
                <span class="badge bg-dark text-warning rounded-pill">Proses</span>
            </div>
            <h2 class="mb-0 fw-bold display-5">{{ $total_proses }}</h2>
            <p class="mb-0 small opacity-75">Sedang Dikerjakan</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 rounded-4 bg-success text-white" style="background: linear-gradient(135deg, #2ec4b6 0%, #20a4f3 100%);">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <i class="bi bi-check2-circle fs-3 opacity-50"></i>
                <span class="badge bg-white text-success rounded-pill">Siap</span>
            </div>
            <h2 class="mb-0 fw-bold display-5">{{ $total_siap }}</h2>
            <p class="mb-0 small opacity-75">Siap Diambil</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 rounded-4 bg-danger text-white" style="background: linear-gradient(135deg, #ef476f 0%, #d90429 100%);">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <i class="bi bi-wallet2 fs-3 opacity-50"></i>
                <span class="badge bg-white text-danger rounded-pill">Omset</span>
            </div>
            <h4 class="mb-0 fw-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h4>
            <p class="mb-0 small opacity-75">Total Pendapatan</p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8 mb-4 mb-md-0">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-graph-up-arrow me-2"></i>Tren Pendapatan 7 Hari Terakhir</h5>
                <canvas id="incomeChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <!-- Quick Action or Small Info could go here, for now keeping layout clean -->
        <div class="card border-0 shadow-sm h-100 rounded-4 bg-light">
             <div class="card-body p-4 text-center d-flex flex-column justify-content-center align-items-center">
                 <img src="https://cdn-icons-png.flaticon.com/512/2910/2910768.png" width="100" class="mb-3 opacity-75">
                 <h6 class="fw-bold text-muted">Kelola Toko</h6>
                 <p class="text-secondary small">Gunakan menu di atas untuk menambah produk baru atau melihat laporan.</p>
             </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <div class="card-header bg-white border-0 py-3 px-4">
        <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-list-task me-2"></i>Daftar Transaksi Terbaru</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-secondary">
                <tr>
                    <th class="px-4 border-0">Pelanggan</th>
                    <th class="border-0">Status Laundry</th>
                    <th class="border-0">Tagihan</th>
                    <th class="text-center border-0" width="200">Aksi & Kontrol</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $key => $d)
                @php
                    $status_raw = strtolower($d->status);
                    $badge = match($status_raw) {
                        'pending' => 'bg-secondary',
                        'diproses' => 'bg-warning text-dark',
                        'siap ambil' => 'bg-info text-dark',
                        'selesai' => 'bg-success',
                        default => 'bg-light text-dark'
                    };
                @endphp
                <tr>
                    <td class="px-4">
                        <div class="fw-bold text-dark">{{ $d->nama }}</div>
                        <small class="text-muted"><i class="bi bi-hash me-1"></i>Order ID: {{ $d->id }}</small>
                    </td>
                    <td>
                        <span class="badge {{ $badge }} rounded-pill px-3 py-2 fw-normal">
                            {{ strtoupper($d->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="fw-bold text-primary">Rp {{ number_format($d->total, 0, ',', '.') }}</div>
                        <small class="text-muted">{{ $d->jenis }}</small>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            @if($status_raw != 'selesai')
                                <a href="{{ url('/pembayaran/'.$d->id) }}" class="btn btn-primary btn-sm rounded-3 shadow-sm px-3" title="Bayar Tagihan">
                                    <i class="bi bi-wallet2 me-1"></i> Bayar
                                </a>
                                <a href="{{ url('/update-status/'.$d->id) }}" class="btn btn-warning btn-sm rounded-3 shadow-sm px-3 text-dark" title="Update Status to Next Step">
                                    <i class="bi bi-arrow-right-circle me-1"></i> Proses
                                </a>
                            @else
                                <a href="{{ url('/nota/'.$d->id) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-3 px-3" title="Cetak Nota">
                                    <i class="bi bi-printer me-1"></i> Nota
                                </a>
                            @endif
                            <a href="{{ url('/hapus/'.$d->id) }}" class="btn btn-outline-danger btn-sm rounded-3 ms-1" onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus Data">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ url('/transaksi/tambah') }}" method="POST" class="modal-content border-0 shadow-lg rounded-4">
            @csrf
            <div class="modal-header bg-primary text-white border-0 rounded-top-4">
                <h5 class="modal-title fw-bold">Buat Transaksi Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Pelanggan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                        <input type="text" name="nama" class="form-control bg-light border-0" required placeholder="Contoh: Budi Santoso">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Layanan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-basket"></i></span>
                        <input type="text" name="jenis" class="form-control bg-light border-0" required placeholder="Contoh: Cuci Komplit 5kg">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Biaya (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">Rp</span>
                        <input type="number" name="total" class="form-control bg-light border-0" required placeholder="0">
                    </div>
                </div>
                <input type="hidden" name="status" value="diproses">
            </div>
            <div class="modal-footer border-0 pt-0 px-4 pb-4">
                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('incomeChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($grafik_label) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($grafik_data) !!},
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#4361ee',
                pointRadius: 5,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e1e1e',
                    titleFont: { family: 'Poppins' },
                    bodyFont: { family: 'Poppins' },
                    padding: 10,
                    cornerRadius: 10,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [5, 5], color: '#f0f0f0' },
                    ticks: { font: { family: 'Poppins' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Poppins' } }
                }
            }
        }
    });
</script>
@endsection
