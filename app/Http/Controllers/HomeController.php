<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\SavingTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', Auth::user()->id)->first();
        $saldo = $users->balance;

        $histories = Transaction::where('payable_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(3);
        $totalHistoryIn = Transaction::where('payable_id', Auth::user()->id)->where('type', 'deposit')->sum('amount');
        $totalHistoryOut = Transaction::where('payable_id', Auth::user()->id)->where('type', 'withdraw')->sum('amount');

        $simWajib = SavingTransaction::where('jenis_id', 41)
                    ->where('akun', 'Setoran')
                    ->where('anggota_id', Auth::user()->id)
                    ->sum('jumlah');

        $totalSimpananSukarela = SavingTransaction::where('jenis_id', 32)
                ->where('akun', 'Setoran')
                ->where('anggota_id', Auth::user()->id)
                ->sum('jumlah');
        $totalTransaksiTarik = SavingTransaction::where('jenis_id', 32)
                ->where('akun', 'Penarikan')
                ->where('anggota_id', Auth::user()->id)
                ->sum('jumlah');
        $simSukarela = $totalSimpananSukarela - $totalTransaksiTarik;

        // return json_encode($histories);
        return view('home', compact('saldo', 'histories', 'totalHistoryIn', 'totalHistoryOut', 'simWajib', 'simSukarela'));
    }

    public function adminHome()
    {
        $totalUser = User::where('type', 'user')->count();

        $totalSimpanan = SavingTransaction::where('akun', 'Setoran')->sum('jumlah');
        $totalPenarikan = SavingTransaction::where('akun', 'Penarikan')->sum('jumlah');
        $totalPembiayaan = Loan::sum('jumlah');

        return view('adminHome', compact('totalUser', 'totalPenarikan', 'totalSimpanan', 'totalPembiayaan'));
    }

    public function mitraHome()
    {
        return view('mitraHome');
    }
}
