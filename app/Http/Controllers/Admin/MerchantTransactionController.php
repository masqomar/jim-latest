<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Bavix\Wallet\External\Dto\Extra;
use Bavix\Wallet\External\Dto\Option;
use Illuminate\Support\Facades\Auth;

class MerchantTransactionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:penarikan simpanan view')->only('index', 'show');
    //     $this->middleware('permission:penarikan simpanan create')->only('create', 'store');
    //     $this->middleware('permission:penarikan simpanan edit')->only('edit', 'update');
    //     $this->middleware('permission:penarikan simpanan delete')->only('delete');
    // }
    public function index()
    {
        if (request()->ajax()) {
            $query = DB::table('transactions')
                ->leftJoin('users', 'users.id', 'transactions.payable_id')
                ->where('users.type', 'store')
                ->select('users.first_name', 'users.member_id', 'transactions.amount', 'transactions.id', 'transactions.created_at', 'transactions.meta')
                ->latest();

            return DataTables::of($query)
                ->addColumn('first_name', function ($row) {
                    return $row->first_name . ' || ' . $row->member_id;
                })->addColumn('meta', function ($row) {
                    return $row->meta ? $row->meta  : 'Pencairan';
                })->addColumn('kode_transaksi', function ($row) {
                    return 'TRB' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                })->addColumn('jumlah', function ($row) {
                    return number_format($row->amount);
                })->toJson();
        }

        return view('merchant-transactions.index');
    }

    public function create()
    {
        return view('merchant-transactions.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'anggota_id' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $nominalPencairan = $request->amount;
        $mitra = User::where('id', $request->anggota_id)->first();
        $namaMitra = User::where('id', $request->anggota_id)->get(['first_name'])->first()->first_name;
        $saldoMitra = $mitra->balanceInt;

        if ($nominalPencairan <= $saldoMitra) {

            $mitra->balanceInt;
            $mitra->withdraw($nominalPencairan);
            $mitra->balanceInt;

            CashTransaction::create([
                'tgl_catat' => $request->tgl_catat,
                'jumlah' => $nominalPencairan,
                'keterangan' => 'Pencairan mitra' . $namaMitra,
                'akun' => 'Pengeluaran',
                'dari_kas_id' => $request->kas_id,
                'jns_trans' => 112,
                'dk' => 'K'
            ]);

            return redirect()->route('merchant-transactions.index')
                ->with('success', 'Pencairan soldo JIMPay mitra   ' . $namaMitra . '  sebesar   Rp. ' . $nominalPencairan . '  berhasil');
        }
        return redirect()->back()->with(['error' => 'Saldo tidak cukup']);
    }
}
