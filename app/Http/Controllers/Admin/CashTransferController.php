<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashTransferRequest;
use App\Models\CashTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CashTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:transfer kas view')->only('index', 'show');
        $this->middleware('permission:transfer kas create')->only('create', 'store');
        $this->middleware('permission:transfer kas edit')->only('edit', 'update');
        $this->middleware('permission:transfer kas delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $cashTransactions = CashTransaction::with('from_cash_type:id,nama', 'to_cash_type:id,nama')->where('akun', 'Transfer')->orderBy('id', 'DESC');

            return DataTables::of($cashTransactions)
            ->addColumn('kode_transaksi', function ($row) {
                return 'TRF' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
            })->addColumn('from_cash_type', function ($row) {
                    return $row->from_cash_type ? $row->from_cash_type->nama : '';
                })->addColumn('to_cash_type', function ($row) {
                    return $row->to_cash_type ? $row->to_cash_type->nama : '';
                })->addColumn('jumlah', function ($row) {
                    return number_format($row->jumlah);
                })->addColumn('action', 'cash-transfers.include.action')
                ->toJson();
        }

        return view('cash-transfers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cash-transfers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashTransferRequest $request)
    {

        CashTransaction::create($request->validated() + (['akun' => 'Transfer', 'jns_trans' => 110]));

        return redirect()
            ->route('cash-transfers.index')
            ->with('success', __('Transfer kas berhasil disimpan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(CashTransaction $cashTransfer)
    {
        $cashTransfer->load('to_cash_type:id,nama', 'account_type:id,kd_aktiva',);

        return view('cash-transfers.show', compact('cashTransfer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(CashTransaction $cashTransfer)
    {
        $cashTransfer->load('to_cash_type:id,nama', 'account_type:id,kd_aktiva');

        return view('cash-transfers.edit', compact('cashTransfer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(CashTransferRequest $request, CashTransaction $cashTransfer)
    {

        $cashTransfer->update($request->validated()  + (['akun' => 'Transfer', 'jns_trans' => 110]));

        return redirect()
            ->route('cash-transfers.index')
            ->with('success', __('Transfer kas berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashTransaction $cashTransfer)
    {
        try {
            $cashTransfer->delete();

            return redirect()
                ->route('cash-transfers.index')
                ->with('success', __('Transfer kas berhasil dihapus.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('cash-transfers.index')
                ->with('error', __("Transfer kas tidak bisa dihapus."));
        }
    }

}
