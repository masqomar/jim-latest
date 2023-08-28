<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BayarController extends Controller
{
    public function index()
    {
        return view('user.bayar.index');
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $merchant = User::where('type', 'store')->where('member_id', $cari)->get();

        if ($merchant) {
            return view('user.bayar.cari', ['anggota' => $merchant]);
        } else {
            return redirect()->route('home')
                ->with('error', 'Tidak menemukan data merchant');
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nominal_bayar' => 'required|numeric',
            'anggota_id' => 'required|numeric',
            'member_id' => 'required|string'
        ]);

        $nominalBayar = $request->nominal_bayar;

        $pengirim = User::where('id', Auth::user()->id)->first();
        $penerima = User::where('id', $request->anggota_id)->first();
        $namaPenerima = User::where('id', $request->anggota_id)->get(['first_name'])->first()->first_name;

        $saldoPengirim = $pengirim->balanceInt;
        $saldoPenerima = $penerima->balanceInt;

        if ($nominalBayar < $saldoPengirim) {
            $pengirim->withdraw($nominalBayar, ['description' => 'Pembelian ke ' . $request->member_id]);
            $pengirim->balance;

            $penerima->deposit($nominalBayar, ['description' => 'Pembayaran dari anggota ' . Auth::user()->member_id]);
            $penerima->balanceInt;

            // $transfer = $pengirim->transfer($penerima, $nominalBayar, new Extra(
            //     deposit: ['description' => 'Pembayaran dari anggota ' . Auth::user()->member_id],
            //     withdraw: new Option(meta: ['description' => 'Pembelian ke ' . $request->member_id], confirmed: true)
            // ));

            // $transfer->withdraw->meta;
            // $transfer->withdraw->confirmed;

            // $transfer->deposit->meta;
            // $transfer->deposit->confirmed;

            // $pengirim->balanceInt;
            // $penerima->balanceInt;

            return redirect()->route('user.bayar.sukses')
                ->with('success', 'Pembayaran Ke   ' . $namaPenerima . '  sebesar   Rp. ' . number_format($nominalBayar) . '  berhasil');
        }
        return redirect()->back()->with(['error' => 'Saldo tidak cukup']);
    }

    public function sukses()
    {
        return view('user.bayar.sukses');
    }
}
