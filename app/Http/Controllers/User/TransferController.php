<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bavix\Wallet\External\Dto\Extra;
use Bavix\Wallet\External\Dto\Option;

class TransferController extends Controller
{
    public function index()
    {
        return view('user.transfer.index');
    }

    public function manualTransfer()
    {
        return view('user.transfer.manual');
    }

    function fetch(Request $request)
    {
        $data = User::select("first_name as value", "id", "member_id")
            ->where('type', 'user')
            ->where('status', 1)
            ->where('first_name', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    public function simpanManualTransfer(Request $request)
    {
        $request->validate([
            'nominal_transfer' => 'required|numeric',
            'nama_penerima' => 'required|string',
            'member_id' => 'required|string',
            'anggota_id' => 'required|numeric'
        ]);

        $nominalTransfer = $request->nominal_transfer;

        $pengirim = User::where('id', Auth::user()->id)->first();
        $penerima = User::where('id', $request->anggota_id)->first();

        $saldoPengirim = $pengirim->balanceInt;

        if ($nominalTransfer < $saldoPengirim) {
            $transfer = $pengirim->transfer($penerima, $nominalTransfer, new Extra(
                deposit: ['description' => 'Transfer dari anggota ' . Auth::user()->member_id],
                withdraw: new Option(meta: ['description' => 'Transfer ke anggota ' . $request->member_id], confirmed: true)
            ));

            $transfer->withdraw->meta;
            $transfer->withdraw->confirmed;

            $transfer->deposit->meta;
            $transfer->deposit->confirmed;

            $pengirim->balanceInt;
            $penerima->balanceInt;

            return redirect()->route('user.transfer.index')->with(['success' => 'Transfer berhasil']);
        }
        return redirect()->back()->with(['error' => 'Saldo tidak cukup']);
    }

    public function scanTransfer()
    {
        return view('user.transfer.scantransfer');
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $anggota = User::where('type', 'user')->where('member_id', $cari)->get();

        if ($anggota) {
            return view('user.transfer.cari', ['anggota' => $anggota]);
        }
        return redirect()->route('home')
            ->with('error', 'Tidak menemukan data anggota');
    }

    public function kirimSaldo(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nominal_transfer' => 'required|numeric',
            'anggota_id' => 'required|numeric',
            'member_id' => 'required|string'
        ]);

        $nominalTransfer = $request->nominal_transfer;

        $pengirim = User::where('id', Auth::user()->id)->first();
        $penerima = User::where('id', $request->anggota_id)->first();

        $saldoPengirim = $pengirim->balanceInt;

        if ($nominalTransfer < $saldoPengirim) {
            $transfer = $pengirim->transfer($penerima, $nominalTransfer, new Extra(
                deposit: ['description' => 'Transfer dari anggota ' . Auth::user()->member_id],
                withdraw: new Option(meta: ['description' => 'Transfer ke anggota ' . $request->member_id], confirmed: true)
            ));

            $transfer->withdraw->meta;
            $transfer->withdraw->confirmed;

            $transfer->deposit->meta;
            $transfer->deposit->confirmed;

            $pengirim->balanceInt;
            $penerima->balanceInt;

            return redirect()->route('user.transfer.index')->with(['success' => 'Transfer berhasil']);
        }
        return redirect()->back()->with(['error' => 'Saldo tidak cukup']);
    }
}
