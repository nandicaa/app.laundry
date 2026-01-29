<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Laundry',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Sample Products
        Product::create([
            'name' => 'Cuci Kering',
            'description' => 'Cuci pakaian hingga kering wangi, siap pakai.',
            'price' => 6000,
            'type' => 'kiloan',
            'image' => null
        ]);

        Product::create([
            'name' => 'Cuci Setrika',
            'description' => 'Paket komplit cuci kering ditambah setrika rapi.',
            'price' => 8000,
            'type' => 'kiloan',
            'image' => null
        ]);

        Product::create([
            'name' => 'Bedcover Besar',
            'description' => 'Cuci bedcover ukuran King/Queen.',
            'price' => 35000,
            'type' => 'satuan',
            'image' => null
        ]);
        
        // Dummy Transactions for Stats
        DB::table('transaksi')->insert([
            ['nama' => 'Budi', 'jenis' => 'Cuci Kering', 'status' => 'diproses', 'total' => 30000, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Siti', 'jenis' => 'Cuci Setrika', 'status' => 'siap ambil', 'total' => 45000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
