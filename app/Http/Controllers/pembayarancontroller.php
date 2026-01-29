<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Transaksi;

class PembayaranController extends Controller
{
    public function show($id)
    {
        $data = Transaksi::find($id);
        return view('pembayaran.index', compact('data'));
    }

    public function store(Request $request)
    {
        $kembalian = $request->jumlah_terima - $request->total_tagihan;

        Pembayaran::create([
            'id_transaksi'=>$request->id_transaksi,
            'tgl_bayar'=>now(),
            'total_tagihan'=>$request->total_tagihan,
            'jumlah_terima'=>$request->jumlah_terima,
            'kembalian'=>$kembalian
        ]);

        Transaksi::where('id', $request->id_transaksi)
            ->update(['status'=>'selesai']);

        return redirect('/nota/'.$request->id_transaksi);
    }

    public function nota($id)
    {
        $d = Transaksi::with('pembayaran')->find($id);

        if (!$d || !$d->pembayaran) {
            return redirect('/dashboard')->withErrors(['Data nota tidak ditemukan']);
        }

        // Mapping for view compatibility
        $d->jumlah_terima = $d->pembayaran->jumlah_terima;
        $d->kembalian = $d->pembayaran->kembalian;
        $d->tgl_bayar = $d->pembayaran->tgl_bayar;

        return view('nota_cetak', compact('d'));
    }
}
