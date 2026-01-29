<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $myOrders = [];

        if (Auth::check() && Auth::user()->role === 'customer') {
            $myOrders = Transaksi::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();
            
            $stats = [
                'active' => Transaksi::where('user_id', Auth::id())->whereIn('status', ['pending', 'diproses', 'siap ambil'])->count(),
                'completed' => Transaksi::where('user_id', Auth::id())->where('status', 'selesai')->count(),
                'expense' => Transaksi::where('user_id', Auth::id())->where('status', 'selesai')->sum('total')
            ];
        } else {
            $stats = [];
        }

        return view('welcome', compact('products', 'myOrders', 'stats'));
    }
}
