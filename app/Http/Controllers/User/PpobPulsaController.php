<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DigiflazzAccount;
use App\Models\PulsaList;
use App\Models\User;
use Illuminate\Http\Request;
use Gonon\Digiflazz\Digiflazz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PpobPulsaController extends Controller
{
    public function index()
    {
        $allPulsa = PulsaList::orderBy('margin')->get();

        return view('user.pulsa-data.index', compact('allPulsa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|max:255',
            'nama_produk' => 'required|max:255',
            'nomor' => 'required|numeric',
        ]);

        $userDigi = DigiflazzAccount::select('username')->first()->username;
        $apiKeyDigi = DigiflazzAccount::select('api_key')->first()->api_key;

        Digiflazz::initDigiflazz($userDigi, $apiKeyDigi);

        $harga = PulsaList::where('sku', $request->sku)->get(['margin'])->first()->margin;

        $pembeli = User::where('id', Auth::user()->id)->first();
        $saldoPembeli = $pembeli->balanceInt;

        if ($harga < $saldoPembeli) {
            DB::transaction(function () use ($request, $pembeli, $harga) {
                $params = [
                    'buyer_sku_code' => $request->sku,
                    'customer_no' => '0' . $request->nomor,
                    'ref_id' => Str::random(10),
                ];

                $createTrasaction = \Gonon\Digiflazz\Transaction::createTransaction($params);

                $pembeli->withdraw($harga, ['description' => 'Pembelian pulsa sebesar ' . number_format($harga)]);
                $pembeli->balance;
            });
            return back()->with('success', 'Pembayaran Pembelian   ' . $request->nama_produk . '  sebesar   Rp. ' . number_format($harga) . '  berhasil');
        }
        return back()->with(['error' => 'Saldo tidak cukup']);
    }
}
