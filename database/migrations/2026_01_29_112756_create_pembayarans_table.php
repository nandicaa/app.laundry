<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pembayaran')) {
            Schema::create('pembayaran', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_transaksi');
                $table->dateTime('tgl_bayar');
                $table->integer('total_tagihan');
                $table->integer('jumlah_terima');
                $table->integer('kembalian');
                $table->timestamps();

                // Relation (Opional strictly enforcing FK if data exists might be risky but good practice)
                // $table->foreign('id_transaksi')->references('id')->on('transaksi')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
