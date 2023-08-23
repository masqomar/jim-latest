<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingTransaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanLaporanController extends Controller
{
    public function index()
    {
        return view('laporan-laporan.index');
    }

    public function generatePdfSetoran(Request $request)
    {
        $data = SavingTransaction::with('user:id,first_name,member_id', 'saving_type:id,jns_simpan')->where('akun', 'Setoran')->latest()->get();
        $data = $data->whereBetween('tgl_transaksi', [$request->from_date, $request->to_date]);
        view()->share('laporan-laporan.setoranPdf',$data);
      $pdf = PDF::loadView('laporan-laporan.setoranPdf', $data);
        
      return $pdf->download('pdf_file.pdf');
    }


}
