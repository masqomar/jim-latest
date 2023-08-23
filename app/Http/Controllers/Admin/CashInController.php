<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashInRequest;
use App\Models\CashTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CashInController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pemasukan kas view')->only('index', 'show');
        $this->middleware('permission:pemasukan kas create')->only('create', 'store');
        $this->middleware('permission:pemasukan kas edit')->only('edit', 'update');
        $this->middleware('permission:pemasukan kas delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $cashTransactions = CashTransaction::with('to_cash_type:id,nama', 'account_type:id,jns_trans')->where('akun', 'Pemasukan')->orderBy('id', 'DESC');

            return DataTables::of($cashTransactions)
            ->addColumn('kode_transaksi', function ($row) {
                return 'TKD' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
            })->addColumn('jumlah', function ($row) {
                    return number_format($row->jumlah);
                })->addColumn('action', 'cash-ins.include.action')
                ->make(true);
        }

        return view('cash-ins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cash-ins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashInRequest $request)
    {

        CashTransaction::create($request->validated() + (['akun' => 'Pemasukan', 'dk' => 'D']));

        return redirect()
            ->route('cash-ins.index')
            ->with('success', __('Pemasukan kas berhasil disimpan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(CashTransaction $cashIn)
    {
        $cashIn->load('to_cash_type:id,nama', 'account_type:id,kd_aktiva',);

        return view('cash-ins.show', compact('cashIn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(CashTransaction $cashIn)
    {
        $cashIn->load('to_cash_type:id,nama', 'account_type:id,kd_aktiva');

        return view('cash-ins.edit', compact('cashIn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(CashInRequest $request, CashTransaction $cashIn)
    {

        $cashIn->update($request->validated() + (['akun' => 'Pemasukan', 'dk' => 'D']));

        return redirect()
            ->route('cash-ins.index')
            ->with('success', __('Pemasukan kas berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashTransaction $cashIn)
    {
        try {
            $cashIn->delete();

            return redirect()
                ->route('cash-ins.index')
                ->with('success', __('Pemasukan kas berhasil dihapus.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('cash-ins.index')
                ->with('error', __("Pemasukan kas tidak bisa dihapus."));
        }
    }

}