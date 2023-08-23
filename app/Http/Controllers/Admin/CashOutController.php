<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashOutRequest;
use App\Models\CashTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CashOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengeluaran kas view')->only('index', 'show');
        $this->middleware('permission:pengeluaran kas create')->only('create', 'store');
        $this->middleware('permission:pengeluaran kas edit')->only('edit', 'update');
        $this->middleware('permission:pengeluaran kas delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $cashTransactions = CashTransaction::with('from_cash_type:id,nama', 'account_type:id,jns_trans')->where('akun', 'Pengeluaran')->orderBy('tgl_catat', 'DESC');

            return DataTables::of($cashTransactions)
            ->addColumn('kode_transaksi', function ($row) {
                return 'TKK' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
            })->addColumn('jumlah', function ($row) {
                    return number_format($row->jumlah);
                })->addColumn('action', 'cash-outs.include.action')
                ->toJson();
        }

        return view('cash-outs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cash-outs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashOutRequest $request)
    {

        CashTransaction::create($request->validated() + (['akun' => 'Pengeluaran', 'dk' => 'K']));

        return redirect()
            ->route('cash-outs.index')
            ->with('success', __('Pengeluaran kas berhasil disimpan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(CashTransaction $cashOut)
    {
        $cashOut->load('to_cash_type:id,nama', 'account_type:id,kd_aktiva',);

        return view('cash-outs.show', compact('cashOut'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(CashTransaction $cashOut)
    {
        $cashOut->load('to_cash_type:id,nama', 'account_type:id,kd_aktiva');

        return view('cash-outs.edit', compact('cashOut'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(CashOutRequest $request, CashTransaction $cashOut)
    {

        $cashOut->update($request->validated()  + (['akun' => 'Pengeluaran', 'dk' => 'K']));

        return redirect()
            ->route('cash-outs.index')
            ->with('success', __('Pengeluaran kas berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashTransaction  $cashTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashTransaction $cashOut)
    {
        try {
            $cashOut->delete();

            return redirect()
                ->route('cash-outs.index')
                ->with('success', __('Pengeluaran kas berhasil dihapus.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('cash-outs.index')
                ->with('error', __("Pengeluaran kas tidak bisa dihapus."));
        }
    }

}
