<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserTopup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    public function index()
    {
        return view('user.topup.index');
    }

    public function topUpCash()
    {
        return view('user.topup.cash');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal_topup' => 'required|numeric'
        ]);

        UserTopup::create([
            'amount' => $request->nominal_topup,
            'user_id' => Auth::user()->id,
            'date' => Carbon::now(),
            'note' => 'Topup Cash',
            'status' => 'Diproses'
        ]);

        return redirect()->route('user.topup.konfirmasi');
    }

    public function konfirmasi()
    {
        return view('user.topup.konfirmasi');
    }

    // public function topUpSukarela()
    // {
    //     $anggota = Auth::user()->id;
    //     $saldoSukarela = UserSaving::where('user_id', $anggota)->where('kop_product_id', 3)->sum('amount');
    //     $topUpJimpay = UserTopup::where('user_id', $anggota)->where('note', 'Saldo Sukarela')->sum('amount');
    //     $totalTransaksiTarik = UserSavingTransaction::where('user_id', $anggota)->where('kop_product_id', 3)->sum('amount');

    //     $sisaSimSukarela = $saldoSukarela - $topUpJimpay - $totalTransaksiTarik;

    //     return view('user.topup.sukarela', compact('sisaSimSukarela'));
    // }
}
