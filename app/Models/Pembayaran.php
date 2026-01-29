<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Explicit table name
    protected $fillable = ['id_transaksi', 'tgl_bayar', 'total_tagihan', 'jumlah_terima', 'kembalian'];
    public $timestamps = false; // Usually payment log doesn't need updated_at, but we can enable if needed

    /**
     * Get the transaction that owns the payment.
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
