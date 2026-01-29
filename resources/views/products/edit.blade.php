@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-warning text-dark py-3 px-4 border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Layanan</h5>
            </div>
            <div class="card-body p-4 bg-white">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Nama Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-tag"></i></span>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2" value="{{ $product->name }}" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary">Harga (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">Rp</span>
                                <input type="number" name="price" class="form-control bg-light border-0 py-2" value="{{ $product->price }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary">Satuan Hitung</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-calculator"></i></span>
                                <select name="type" class="form-select bg-light border-0 py-2" required>
                                    <option value="kiloan" {{ $product->type == 'kiloan' ? 'selected' : '' }}>Per Kilogram (Kg)</option>
                                    <option value="satuan" {{ $product->type == 'satuan' ? 'selected' : '' }}>Per Potong (Pcs)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Deskripsi Singkat</label>
                        <textarea name="description" class="form-control bg-light border-0" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Foto Layanan</label>
                        @if($product->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/'.$product->image) }}" width="120" class="rounded-3 shadow-sm border">
                                <div class="small text-muted mt-1">Foto Saat Ini</div>
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control bg-light border-0">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('products.index') }}" class="btn btn-light rounded-3 px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
