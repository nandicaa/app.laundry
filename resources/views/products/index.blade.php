@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Manajemen Produk</h2>
        <p class="text-muted">Kelola daftar harga dan jenis layanan laundry Anda.</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary shadow-lg rounded-3 fw-bold px-4">
        <i class="bi bi-plus-lg me-2"></i>Tambah Produk
    </a>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
</div>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white border-0 py-3 px-4">
        <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-tags me-2"></i>Daftar Layanan Tersedia</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-secondary">
                <tr>
                    <th class="px-4 border-0">Foto</th>
                    <th class="border-0">Nama Layanan</th>
                    <th class="border-0">Harga</th>
                    <th class="border-0">Tipe Satuan</th>
                    <th class="text-center border-0" width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $key => $product)
                <tr>
                    <td class="px-4">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="img" width="60" height="60" class="rounded-3 shadow-sm object-fit-cover">
                        @else
                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 60px;">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $product->name }}</div>
                        <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                    </td>
                    <td>
                        <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </td>
                    <td>
                        <span class="badge {{ $product->type == 'kiloan' ? 'bg-info text-dark' : 'bg-warning text-dark' }} rounded-pill px-3 py-2 fw-normal">
                            {{ ucfirst($product->type) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm rounded-3" title="Edit Layanan">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3" title="Hapus Layanan">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486777.png" width="80" class="opacity-50 mb-3">
                        <p class="text-muted fw-bold">Belum ada layanan yang ditambahkan.</p>
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Tambah Sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
