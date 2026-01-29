<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pembayaran;

class TransaksiController extends Controller {
    // 1. Fungsi Tampilkan Dashboard & Grafik
    public function index() {
        $total_pesanan = Transaksi::count();
        $total_proses = Transaksi::where('status', 'diproses')->count();
        $total_siap = Transaksi::where('status', 'siap ambil')->count();
        $pendapatan = Pembayaran::sum('jumlah_terima') ?? 0;

        $grafik_label = []; $grafik_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-$i day"));
            $grafik_label[] = date('D', strtotime($tgl));
            $grafik_data[] = Pembayaran::whereDate('tgl_bayar', $tgl)->sum('jumlah_terima') ?? 0;
        }
        $transaksi = Transaksi::orderBy('id', 'desc')->get();
        return view('main_pages', compact('total_pesanan','total_proses','total_siap','pendapatan','grafik_label','grafik_data','transaksi'));
    }

    // 2. Fungsi Tambah Transaksi
    public function tambah(Request $request) {
        Transaksi::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'status' => 'diproses',
            'total' => $request->total
        ]);
        return redirect('/dashboard');
    }

    // 3. Fungsi Update Status
    public function updateStatus($id) {
        $t = Transaksi::find($id);
        $status = ($t->status == 'diproses') ? 'siap ambil' : 'selesai';
        $t->update(['status' => $status]);
        return redirect('/dashboard');
    }

    // 4. Fungsi Hapus Transaksi
    public function hapus($id) {
        Transaksi::destroy($id);
        return redirect('/dashboard');
    }
}