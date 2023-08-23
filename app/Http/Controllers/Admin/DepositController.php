<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\SavingTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:setoran simpanan view')->only('index', 'show');
        $this->middleware('permission:setoran simpanan create')->only('create', 'store');
        $this->middleware('permission:setoran simpanan edit')->only('edit', 'update');
        $this->middleware('permission:setoran simpanan delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         if(request()->ajax()) {
            $data = SavingTransaction::with('user:id,first_name,member_id', 'saving_type:id,jns_simpan')->where('akun', 'Setoran')->latest();
            if(!empty($request->from_date)) {

                $data = $data->whereBetween('tgl_transaksi', [$request->from_date, $request->to_date]);

            } else {

                $data = SavingTransaction::with('user:id,first_name,member_id', 'saving_type:id,jns_simpan')->where('akun', 'Setoran')->latest();

            }
            return DataTables::of($data)
            ->addColumn('kode_transaksi', function ($row) {
                return 'TRD' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
            })->addColumn('jumlah', function ($row) {
                return number_format($row->jumlah);
            })->addColumn('action', 'deposits.include.action')
            ->make(true);
        }

        return view('deposits.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deposits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepositRequest $request)
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
                    'akun' => 'Setoran',
                    'dk' => 'D',
                ]);
            }
        });

        return redirect()
            ->route('deposits.index')
            ->with('success', __('Setoran simpanan berhasil disimpan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(SavingTransaction $deposit)
    {
        $deposit->load('user:id,first_name', 'saving_type:id,jns_simpan');

        return view('deposits.show', compact('deposit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(SavingTransaction $deposit)
    {
        $deposit->load('user:id,first_name', 'saving_type:id,jns_simpan');

        return view('deposits.edit', compact('deposit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(DepositRequest $request, SavingTransaction $deposit)
    {

        $deposit->update($request->validated() + (['akun' => 'Setoran', 'dk' => 'D']));

        return redirect()
            ->route('deposits.index')
            ->with('success', __('Setoran simpanan berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SavingTransaction  $savingTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(SavingTransaction $deposit)
    {
        try {
            $deposit->delete();

            return redirect()
                ->route('deposits.index')
                ->with('success', __('Setoran simpanan berhasil dihapus.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('deposits.index')
                ->with('error', __("Setoran simpanan tidak bisa dihapus."));
        }
    }

}
