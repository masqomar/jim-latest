<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RapatAkhirTahunController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'user')->get();

        return view('rat.index', compact('users'));
    }

    public function generatePDF(Request $request)
    {
        // dd($request->all());
        $tahun = date('Y', strtotime($request->tanggal));
        $tahunAwal = $tahun . '-01-01';

        $totalPinjaman = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$tahunAwal, $request->tanggal])->sum('jumlah');
        $keuntungan = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$tahunAwal, $request->tanggal])->sum(DB::raw('biaya_adm * lama_angsuran'));
        $kembang = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$tahunAwal, $request->tanggal])->sum(DB::raw('bunga_pinjaman * lama_angsuran'));
        $tagihan = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$tahunAwal, $request->tanggal])->sum(DB::raw('tagihan'));
        $pembulatan = $tagihan - ($totalPinjaman + +$kembang + $keuntungan);
        $totalAngsuran = DB::table('loan_details')
        ->leftJoin("loans", 'loans.id', 'loan_details.pinjam_id')        
        ->whereBetween('loans.tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])
        ->sum('jumlah_bayar');
        $pendapatanPinjaman = $totalAngsuran - $totalPinjaman;

        $data = [
            'tanggal' => $request->tanggal,
            'tahun' => $tahun,
            'ketua' => $request->ketua,
            'sekretaris' => $request->sekretaris,
            'jumlah_pinjaman' => $totalPinjaman,
            'pendapatan_margin_pinjaman' => $keuntungan,
            'pendapatan_biaya_pembulanan' => $pembulatan,
            'jumlah_tagihan' => $tagihan,
            'estimasi_pendapatan_pinjaman' => $pendapatanPinjaman,
        ];

        //   return json_encode($akunPendapatan);

        $pdf = PDF::loadView('rat.ratPdf', $data);

        return $pdf->stream();
    }
}
