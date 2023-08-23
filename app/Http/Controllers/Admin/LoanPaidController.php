<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanPaidController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pinjaman lunas view')->only('index', 'show');
        $this->middleware('permission:pinjaman lunas create')->only('create', 'store');
        $this->middleware('permission:pinjaman lunas edit')->only('edit', 'update');
        $this->middleware('permission:pinjaman lunas delete')->only('delete');
    }

    public function index()
    {
        $pinjamanLunas = DB::table('loans')
        ->leftJoin('loan_details', 'loan_details.pinjam_id', 'loans.id')
        ->leftJoin('users', 'users.id', 'loans.anggota_id')
        ->select('loans.id', 'tgl_pinjam', 'anggota_id', 'lama_angsuran', 'jumlah', 'bunga', 'biaya_adm', 'lunas', 'users.member_id', 'users.first_name', 'users.last_name', DB::raw("SUM(jumlah_bayar) as sudah_bayar"), DB::raw("COUNT(angsuran_ke) as sisa_angsuran"))
        ->groupBy('loans.id', 'tgl_pinjam', 'anggota_id', 'lama_angsuran', 'jumlah', 'bunga', 'biaya_adm', 'lunas', 'users.member_id', 'users.first_name', 'users.last_name')
        ->where('lunas', 'Lunas')
        ->paginate(50);

        return view('loan-paids.index', compact('pinjamanLunas'));
    }
}
