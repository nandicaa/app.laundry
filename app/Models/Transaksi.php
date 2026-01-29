<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Explicit table name because it's singular in DB
    protected $fillable = ['user_id', 'nama', 'jenis', 'status', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the pembayaran associated with the transaction.
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_transaksi');
    }
}
