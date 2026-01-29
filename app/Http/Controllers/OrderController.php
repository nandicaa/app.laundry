<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|numeric|min:1',
            'notes' => 'nullable|string'
        ]);

        $product = Product::find($request->product_id);
        
        // Calculate estimated total (just an estimate, admin confirms later)
        $total = $product->price * $request->qty;

        Transaksi::create([
            'user_id' => Auth::id(),
            'nama' => Auth::user()->name,
            'jenis' => $product->name . ' (' . $product->type . ')',
            'status' => 'pending', // New status for user orders
            'total' => $total
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat! Admin akan segera memprosesnya.');
    }
}
