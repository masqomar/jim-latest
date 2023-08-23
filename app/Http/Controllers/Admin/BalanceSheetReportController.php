<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashType;
use App\Models\ViewTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceSheetReportController extends Controller
{
    public function index()
     {
        $semuaTransaksiDebet = DB::table('cash_types')
        ->leftJoin('v_transaksi', 'v_transaksi.untuk_kas', 'cash_types.id')
        ->select(DB::raw("SUM(debet) as total_debet"), 'cash_types.nama', 'cash_types.id')
        ->groupBy('cash_types.nama', 'cash_types.id')
        ->where('cash_types.aktif', 'Y')
        ->orderBy('id')
        ->get();
        $semuaTransaksiKredit = DB::table('cash_types')
        ->leftJoin('v_transaksi', 'v_transaksi.dari_kas', 'cash_types.id')
        ->select(DB::raw("SUM(kredit) as total_kredit"), 'cash_types.nama', 'cash_types.id')
        ->groupBy('cash_types.nama', 'cash_types.id')
        ->where('cash_types.aktif', 'Y')        
        ->orderBy('id')
        ->get();
         $semuaAkunDebet = DB::table('account_types')
        ->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')
        ->select(DB::raw("SUM(debet) as total_akun_debet"), DB::raw("SUM(kredit) as total_akun_kredit"), 'account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->groupBy('account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->where('account_types.aktif', 'Y')
        ->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')
        ->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')
        ->get();


        return view('balance-sheet-reports.index', compact('semuaTransaksiDebet', 'semuaTransaksiKredit', 'semuaAkunDebet' ));
    }
    public function filter(Request $request)
    {
        
        $semuaTransaksiDebet = DB::table('cash_types')
        ->leftJoin('v_transaksi', 'v_transaksi.untuk_kas', 'cash_types.id')
        ->select(DB::raw("SUM(debet) as total_debet"), 'cash_types.nama', 'cash_types.id')
        ->groupBy('cash_types.nama', 'cash_types.id')
        ->where('cash_types.aktif', 'Y')
        ->whereBetween('v_transaksi.tgl', [$request->dari_tanggal, $request->sampai_tanggal])
        ->orderBy('id')
        ->get();
        $semuaTransaksiKredit = DB::table('cash_types')
        ->leftJoin('v_transaksi', 'v_transaksi.dari_kas', 'cash_types.id')
        ->select(DB::raw("SUM(kredit) as total_kredit"), 'cash_types.nama', 'cash_types.id')
        ->groupBy('cash_types.nama', 'cash_types.id')
        ->where('cash_types.aktif', 'Y')               
        ->whereBetween('v_transaksi.tgl', [$request->dari_tanggal, $request->sampai_tanggal]) 
        ->orderBy('id')
        ->get();
         $semuaAkunDebet = DB::table('account_types')
        ->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')
        ->select(DB::raw("SUM(debet) as total_akun_debet"), DB::raw("SUM(kredit) as total_akun_kredit"), 'account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->groupBy('account_types.kd_aktiva', 'account_types.jns_trans', 'account_types.id', 'account_types.akun')
        ->where('account_types.aktif', 'Y')        
        ->whereBetween('v_transaksi.tgl', [$request->dari_tanggal, $request->sampai_tanggal])
        ->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')
        ->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')
        ->get();


        return view('balance-sheet-reports.index', compact('semuaTransaksiDebet', 'semuaTransaksiKredit', 'semuaAkunDebet' ));
    }
}
