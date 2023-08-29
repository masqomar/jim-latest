<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembiayaanController extends Controller
{
    public function index()
    {
        $anggotaID = Auth::user()->id;
        $pembiayaanAll = Loan::where('anggota_id', $anggotaID)->paginate(5);

        return view('user.pembiayaan.index', compact('anggotaID', 'pembiayaanAll'));
    }

    public function show($id)
    {
        $pinjamanDetail = LoanDetail::with('loan')->where('pinjam_id', $id)->get();
        $totalAngsuran = LoanDetail::where('pinjam_id', $id)->sum('jumlah_bayar');
        
        return view('user.pembiayaan.show', compact('pinjamanDetail', 'totalAngsuran'));
    }
}
