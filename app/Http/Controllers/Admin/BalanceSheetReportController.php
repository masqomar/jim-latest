<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use App\Models\CashType;
use App\Models\ViewTransaksi;
use Illuminate\Http\Request;
use PDF;

class BalanceSheetReportController extends Controller
{
    public function index()
    {
        $jenisKas = CashType::where('aktif', 'Y')->get();
        $saldo = [];
        foreach ($jenisKas as $saldoKas) {
            $saldo[] = [
                'kas_id' => $saldoKas->id,
                'kas_nama' => $saldoKas->nama,
                'sisaSaldo' => ViewTransaksi::where('untuk_kas', $saldoKas->id)->sum('debet') - ViewTransaksi::where('dari_kas', $saldoKas->id)->sum('kredit')
            ];
        }

        $jenisAkun = AccountType::where('aktif', 'Y')->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')->get();

        return view('balance-sheet-reports.index', compact('saldo', 'jenisAkun'));
    }
    public function filter(Request $request)
    {
        $jenisKas = CashType::where('aktif', 'Y')->get();
        $saldo = [];
        foreach ($jenisKas as $saldoKas) {
            $saldo[] = [
                'kas_id' => $saldoKas->id,
                'kas_nama' => $saldoKas->nama,
                'sisaSaldo' => ViewTransaksi::where('untuk_kas', $saldoKas->id)->whereBetween('tgl', [$request->dari_tanggal, $request->sampai_tanggal])->sum('debet') - ViewTransaksi::where('dari_kas', $saldoKas->id)->whereBetween('tgl', [$request->dari_tanggal, $request->sampai_tanggal])->sum('kredit')
            ];
        }

        $jenisAkun = AccountType::where('aktif', 'Y')->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')->get();

        return view('balance-sheet-reports.index', compact('saldo', 'jenisAkun'));
    }
    public function cetak_pdf(Request $request)
    {
    	$jenisKas = CashType::where('aktif', 'Y')->get();
        $saldo = [];
        foreach ($jenisKas as $saldoKas) {
            $saldo[] = [
                'kas_id' => $saldoKas->id,
                'kas_nama' => $saldoKas->nama,
                'sisaSaldo' => ViewTransaksi::where('untuk_kas', $saldoKas->id)->whereBetween('tgl', [$request->dari_tanggal, $request->sampai_tanggal])->sum('debet') - ViewTransaksi::where('dari_kas', $saldoKas->id)->whereBetween('tgl', [$request->dari_tanggal, $request->sampai_tanggal])->sum('kredit')
            ];
        }

        $jenisAkun = AccountType::where('aktif', 'Y')->orderByRaw('LPAD(kd_aktiva, 1, 0) ASC')->orderByRaw('LPAD(kd_aktiva, 5, 1) ASC')->get();
 
    	$pdf = PDF::loadview('balance-sheet-reports.cetak_pdf',compact('saldo', 'jenisAkun'))->setPaper('A4', 'portrait');
    	return $pdf->stream();
    }
}
