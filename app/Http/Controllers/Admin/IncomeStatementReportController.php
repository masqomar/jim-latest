<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeStatementReportController extends Controller
{
    public function index()
    {
        $totalPinjaman = DB::table('v_hitung_pinjaman')->sum('jumlah');
        $keuntungan = DB::table('v_hitung_pinjaman')->sum(DB::raw('biaya_adm * lama_angsuran'));
        $kembang = DB::table('v_hitung_pinjaman')->sum(DB::raw('bunga_pinjaman * lama_angsuran'));
        $tagihan = DB::table('v_hitung_pinjaman')->sum(DB::raw('tagihan'));
        $pembulatan = $tagihan - ($totalPinjaman + + $kembang + $keuntungan); 
        $estimasiPendapatan = $tagihan - $totalPinjaman;

        $totalAngsuran = DB::table('loan_details')
        ->leftJoin('loans', 'loans.id', 'loan_details.pinjam_id')
        ->sum('jumlah_bayar');

        $pendapatanPinjaman = $totalAngsuran - $totalPinjaman;

        $akunPendapatan = DB::table('account_types')
        ->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')
        ->select(DB::raw("SUM(debet) as total_akun_debet"), DB::raw("SUM(kredit) as total_akun_kredit"), 'account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->groupBy('account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->where('account_types.aktif', 'Y')
        ->where('laba_rugi', 'PENDAPATAN')
        ->havingRaw('CHAR_LENGTH(kd_aktiva) > 1')
        ->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')
        ->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')
        ->get();

        $akunBiaya = DB::table('account_types')
        ->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')
        ->select(DB::raw("SUM(debet) as total_biaya_debet"), DB::raw("SUM(kredit) as total_biaya_kredit"), 'account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->groupBy('account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->where('account_types.aktif', 'Y')
        ->where('laba_rugi', 'BIAYA')
        ->havingRaw('CHAR_LENGTH(kd_aktiva) > 1')
        ->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')
        ->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')
        ->get();
        
        return view('income-statement-reports.index', compact('totalPinjaman', 'keuntungan', 'kembang', 'pembulatan', 'tagihan', 'estimasiPendapatan', 'pendapatanPinjaman', 'akunPendapatan', 'akunBiaya'));
    }

    public function filter(Request $request)
    {
        $totalPinjaman = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])->sum('jumlah');
        $keuntungan = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])->sum(DB::raw('biaya_adm * lama_angsuran'));
        $kembang = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])->sum(DB::raw('bunga_pinjaman * lama_angsuran'));
        $tagihan = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])->sum(DB::raw('tagihan'));
        $pembulatan = $tagihan - ($totalPinjaman + + $kembang + $keuntungan); 
        $estimasiPendapatan = $tagihan - $totalPinjaman;

        $totalAngsuran = DB::table('loan_details')
        ->leftJoin("loans", 'loans.id', 'loan_details.pinjam_id')        
        ->whereBetween('loans.tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])
        ->sum('jumlah_bayar');

        $pendapatanPinjaman = $totalAngsuran - $totalPinjaman;

        $akunPendapatan = DB::table('account_types')
        ->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')
        ->select(DB::raw("SUM(debet) as total_akun_debet"), DB::raw("SUM(kredit) as total_akun_kredit"), 'account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->groupBy('account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->where('account_types.aktif', 'Y')
        ->where('laba_rugi', 'PENDAPATAN')
        ->whereBetween('v_transaksi.tgl', [$request->dari_tanggal, $request->sampai_tanggal])
        ->havingRaw('CHAR_LENGTH(kd_aktiva) > 1')
        ->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')
        ->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')
        ->get();

        $akunBiaya = DB::table('account_types')
        ->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')
        ->select(DB::raw("SUM(debet) as total_biaya_debet"), DB::raw("SUM(kredit) as total_biaya_kredit"), 'account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->groupBy('account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->where('account_types.aktif', 'Y')
        ->where('laba_rugi', 'BIAYA')        
        ->whereBetween('v_transaksi.tgl', [$request->dari_tanggal, $request->sampai_tanggal])
        ->havingRaw('CHAR_LENGTH(kd_aktiva) > 1')
        ->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')
        ->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')
        ->get();
        
        return view('income-statement-reports.index', compact('totalPinjaman', 'keuntungan', 'kembang', 'pembulatan', 'tagihan', 'estimasiPendapatan', 'pendapatanPinjaman', 'akunPendapatan', 'akunBiaya'));
        
    }
}
