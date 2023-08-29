<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class UserTransactionController extends Controller
{
    public function index()
    {
        $dataAnggota = User::where('type', 'user')->paginate(10);
        $angsuran = DB::table('loans')
            ->leftJoin('loan_details', 'loan_details.pinjam_id', 'loans.id')
            ->leftJoin('users', 'users.id', 'loans.anggota_id')
            ->select(DB::raw("SUM(jumlah_bayar) as dibayar"), 'loans.anggota_id')
            ->groupBy('loans.anggota_id')
            ->get();

            return view('user-transactions.index', compact('dataAnggota', 'angsuran'));
    }

    public function cetak_pdf()
    {
        $dataAnggota = User::where('type', 'user')->paginate(10);
        $angsuran = DB::table('loans')
            ->leftJoin('loan_details', 'loan_details.pinjam_id', 'loans.id')
            ->leftJoin('users', 'users.id', 'loans.anggota_id')
            ->select(DB::raw("SUM(jumlah_bayar) as dibayar"), 'loans.anggota_id')
            ->groupBy('loans.anggota_id')
            ->get();

            $pdf = PDF::loadview('user-transactions.cetak_pdf',compact('dataAnggota', 'angsuran'))->setPaper('A4', 'landscape');
            return $pdf->stream();
    }
}
