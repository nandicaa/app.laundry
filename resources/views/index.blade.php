<form action="/pembayaran" method="POST">
@csrf
<input type="hidden" name="id_transaksi" value="{{ $data->id }}">
<input type="hidden" name="total_tagihan" value="{{ $data->total }}">
<input type="number" name="jumlah_terima" required>
<button>Bayar</button>
</form>
