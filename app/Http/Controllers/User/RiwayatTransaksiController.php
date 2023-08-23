<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatTransaksiController extends Controller
{
    public function index()
    {
        $riwayatTransaksiAll = Transaction::where('payable_id', Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('user.riwayat-transaksi.index', compact('riwayatTransaksiAll'));
    }
}
