<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SavingCashReportController extends Controller
{
    public function index()
    {
        $totalSetoranSimPokok = SavingTransaction::where('jenis_id', 40)->where('akun', 'Setoran')->sum('jumlah');
        $totalSetoranSimWajib = SavingTransaction::where('jenis_id', 41)->where('akun', 'Setoran')->sum('jumlah');
        $totalSetoranSimSukarela = SavingTransaction::where('jenis_id', 32)->where('akun', 'Setoran')->sum('jumlah');
        
        $totalPenarikanSimPokok = SavingTransaction::where('jenis_id', 40)->where('akun', 'Penarikan')->sum('jumlah');
        $totalPenarikanSimWajib = SavingTransaction::where('jenis_id', 41)->where('akun', 'Penarikan')->sum('jumlah');
        $totalPenarikanSimSukarela = SavingTransaction::where('jenis_id', 32)->where('akun', 'Penarikan')->sum('jumlah');       

        $saldoSimPokok = $totalSetoranSimPokok - $totalPenarikanSimPokok;
        $saldoSimWajib = $totalSetoranSimWajib - $totalPenarikanSimWajib;
        $saldoSimSukarela = $totalSetoranSimSukarela - $totalPenarikanSimSukarela;

        $totalSetoran = $totalSetoranSimPokok + $totalSetoranSimWajib + $totalSetoranSimSukarela;
        $totalPenarikan = $totalPenarikanSimPokok + $totalPenarikanSimWajib + $totalPenarikanSimSukarela;
        $totalSaldo = $saldoSimPokok + $saldoSimWajib + $saldoSimSukarela;

        return view('saving-cash-reports.index', compact('totalSetoranSimPokok', 'totalSetoranSimWajib', 'totalSetoranSimSukarela', 'totalPenarikanSimPokok', 'totalPenarikanSimWajib', 'totalPenarikanSimSukarela', 'saldoSimPokok', 'saldoSimWajib', 'saldoSimSukarela', 'totalSetoran', 'totalPenarikan', 'totalSaldo'));
    }
}
