@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white p-3 text-center">
                <h5 class="mb-0 fw-bold"><i class="bi bi-cash-stack me-2"></i>Konfirmasi Pembayaran</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ url('/pembayaran') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_transaksi" value="{{ $data->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pelanggan</label>
                        <input type="text" class="form-control bg-light" value="{{ $data->nama }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Total Tagihan (Rp)</label>
                        <input type="number" name="total_tagihan" id="total_tagihan" 
                               class="form-control bg-light fw-bold text-primary" 
                               value="{{ $data->total }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-success">Uang Diterima (Rp)</label>
                        <input type="number" name="jumlah_terima" id="jumlah_terima" 
                               class="form-control form-control-lg border-success" 
                               placeholder="Masukkan nominal..." required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kembalian (Rp)</label>
                        <input type="text" id="tampil_kembalian" class="form-control form-control-lg bg-light" value="0" readonly>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle me-1"></i> Bayar Sekarang
                        </button>
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const inputTerima = document.getElementById('jumlah_terima');
    const totalTagihan = document.getElementById('total_tagihan').value;
    const tampilKembalian = document.getElementById('tampil_kembalian');

    inputTerima.addEventListener('input', function() {
        let bayar = parseFloat(this.value) || 0;
        let sisa = bayar - totalTagihan;

        if (bayar === 0) {
            tampilKembalian.value = "0";
        } else if (sisa < 0) {
            tampilKembalian.value = "Uang Kurang";
            tampilKembalian.classList.add('text-danger');
        } else {
            tampilKembalian.classList.remove('text-danger');
            tampilKembalian.classList.add('text-success');
            tampilKembalian.value = new Intl.NumberFormat('id-ID').format(sisa);
        }
    });
</script>
@endsection
