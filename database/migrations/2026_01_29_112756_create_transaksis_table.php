<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('transaksi')) {
            Schema::create('transaksi', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->string('nama');
                $table->string('jenis');
                $table->string('status')->default('diproses');
                $table->integer('total');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
