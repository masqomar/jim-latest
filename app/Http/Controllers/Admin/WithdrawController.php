<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Models\SavingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:penarikan simpanan view')->only('index', 'show');
        $this->middleware('permission:penarikan simpanan create')->only('create', 'store');
        $this->middleware('permission:penarikan simpanan edit')->only('edit', 'update');
        $this->middleware('permission:penarikan simpanan delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(request()->ajax()) {
            $data = SavingTransaction::with('user:id,first_name,member_id', 'saving_type:id,jns_simpan')->where('akun', 'Penarikan')->latest();
            if(!empty($request->from_date)) {

                $data = $data->whereBetween('tgl_transaksi', [$request->from_date, $request->to_date]);

            } else {

                $data = SavingTransaction::with('user:id,first_name,member_id', 'saving_type:id,jns_simpan')->where('akun', 'Penarikan')->latest();

            }
            return DataTables::of($data)
            ->addColumn('kode_transaksi', function ($row) {
                return 'TRK' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
            })->addColumn('jumlah', function ($row) {
                return number_format($row->jumlah);
                })->addColumn('action', 'withdrawals.include.action')
               ->make(true);
        }

        return view('withdrawals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('withdrawals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WithdrawRequest $request)
    {
        $request->validated();
        DB::transaction(function () use ($request) {
            $id = $request->anggota_id;
            for ($i = 0; $i < count($id); $i++) {
                SavingTransaction::create([
                    'anggota_id' => $id[$i],
                    'tgl_transaksi'    => $request->tgl_transaksi,
                    'jumlah'    => $request->jumlah,
                    'keterangan'    => $request->keterangan,
                    'kas_id'    => $request->kas_id,
                    'jenis_id'    => $request->jenis_id,
                    'akun' => 'Penarikan',
                    'dk' => 'K',
                ]);
            }
        });

        return redirect()
            ->route('withdrawals.index')
            ->with('success', __('Penarikan simpanan berhasil disimpan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(SavingTransaction $withdrawal)
    {
        $withdrawal->load('user:id,first_name', 'saving_type:id,jns_simpan');

        return view('withdrawals.show', compact('withdrawal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(SavingTransaction $withdrawal)
    {
        $withdrawal->load('user:id,first_name', 'saving_type:id,jns_simpan');

        return view('withdrawals.edit', compact('withdrawal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(WithdrawRequest $request, SavingTransaction $withdrawal)
    {

        $withdrawal->update($request->validated() + (['akun' => 'Penarikan', 'dk' => 'K']));

        return redirect()
            ->route('withdrawals.index')
            ->with('success', __('Penarikan simpanan berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(SavingTransaction $withdrawal)
    {
        try {
            $withdrawal->delete();

            return redirect()
                ->route('withdrawals.index')
                ->with('success', __('Penarikan simpanan berhasil dihapus.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('withdrawals.index')
                ->with('error', __("Penarikan simpanan tidak bisa dihapus."));
        }
    }
}
