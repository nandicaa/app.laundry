@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3 px-4 border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Layanan Baru</h5>
            </div>
            <div class="card-body p-4 bg-white">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Nama Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-tag"></i></span>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2" required placeholder="Contoh: Cuci Kering Express">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary">Harga (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">Rp</span>
                                <input type="number" name="price" class="form-control bg-light border-0 py-2" required placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary">Satuan Hitung</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-calculator"></i></span>
                                <select name="type" class="form-select bg-light border-0 py-2" required>
                                    <option value="kiloan">Per Kilogram (Kg)</option>
                                    <option value="satuan">Per Potong (Pcs)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Deskripsi Singkat</label>
                        <textarea name="description" class="form-control bg-light border-0" rows="3" placeholder="Jelaskan detail layanan ini..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Foto Layanan</label>
                        <input type="file" name="image" class="form-control bg-light border-0">
                        <small class="text-muted">*Format: JPG, PNG, JPEG. Max: 2MB</small>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('products.index') }}" class="btn btn-light rounded-3 px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">Simpan Layanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
