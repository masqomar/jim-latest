<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ViewTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CashTransactionReportController extends Controller
{
    public  function index()
    {
        if (request()->ajax()) {
            // $cashTransactions = DB::table('v_transaksi')
            //     ->leftJoin('cash_types as untuk_kas', 'untuk_kas.id', 'v_transaksi.untuk_kas')
            //     ->leftJoin('cash_types as from_kas', 'from_kas.id', 'v_transaksi.dari_kas')
            //     ->leftJoin('saving_types', 'saving_types.id', 'v_transaksi.transaksi')
            //     ->select('v_transaksi.*', 'untuk_kas.nama as nama_untuk_kas', 'from_kas.nama as nama_dari_kas', 'saving_types.jns_simpan')
            //     ->orderBy('tgl', 'ASC');
            $cashTransactions = DB::table('v_transaksi')
                ->leftJoin('cash_types as untuk_kas', 'untuk_kas.id', 'v_transaksi.untuk_kas')
                ->leftJoin('cash_types as from_kas', 'from_kas.id', 'v_transaksi.dari_kas')
                ->leftJoin('account_types', 'account_types.id', 'v_transaksi.transaksi')
                ->select('v_transaksi.*', 'untuk_kas.nama as nama_untuk_kas', 'from_kas.nama as nama_dari_kas', 'account_types.jns_trans')
                ->orderBy('tgl', 'ASC');

            return DataTables::of($cashTransactions)
                ->addColumn('kode_transaksi', function ($row) {
                    if ($row->tbl == "A") {
                        return 'TPJ'  . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                    } elseif ($row->tbl == "B") {
                        return 'TBY'  . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                    } elseif ($row->tbl == "C") {
                        if($row->dari_kas == NULL) {
                           return 'TRD' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                        } else {
                           return 'TRK' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                        }
                        return '-';
                    } elseif ($row->tbl == "D") {
                        if($row->dari_kas == NULL) {
                            return 'TKD' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                        }elseif($row->untuk_kas == NULL) {
                            return 'TKK' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                        }else {
                            return 'TRF' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                        }
                    } else {
                        return 'Kosong Bos';
                    }
                })->addColumn('untuk_kas', function ($row) {
                    return $row->nama_untuk_kas ? $row->nama_untuk_kas : '-';
                })->addColumn('dari_kas', function ($row) {
                    return $row->nama_dari_kas ? $row->nama_dari_kas : '-';
                })->addColumn('transaksi', function ($row) {
                    return $row->jns_trans;
                })->addColumn('debet', function ($row) {
                    return $row->debet ? number_format($row->debet) : '-';
                })->addColumn('kredit', function ($row) {
                    return $row->kredit ? number_format($row->kredit) : '-';
                })->make(true);
        }

        return view('cash-transaction-reports.index');
    }
}
