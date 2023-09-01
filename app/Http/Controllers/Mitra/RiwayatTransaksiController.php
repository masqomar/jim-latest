<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RiwayatTransaksiController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $riwayatTransaksiAll = Transaction::where('payable_id', Auth::user()->id)->orderBy('id', 'DESC');

            return DataTables::of($riwayatTransaksiAll)
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y');
            })->addColumn('amount', function ($row) {
                return number_format($row->amount);
            })->toJson();
        }

        return view('mitra.riwayat-transaksi.index');
    }
}
