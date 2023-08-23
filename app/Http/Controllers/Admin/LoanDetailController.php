<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanDetail;
use App\Http\Requests\{StoreLoanDetailRequest, UpdateLoanDetailRequest};
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LoanDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pinjaman detail view')->only('index', 'show');
        $this->middleware('permission:pinjaman detail create')->only('create', 'store');
        $this->middleware('permission:pinjaman detail edit')->only('edit', 'update');
        $this->middleware('permission:pinjaman detail delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAngsuran =  DB::table('loans')
        ->leftJoin('loan_details', 'loan_details.pinjam_id', 'loans.id')
        ->leftJoin('users', 'users.id', 'loans.anggota_id')
        ->select('loans.id', 'tgl_pinjam', 'anggota_id', 'lama_angsuran', 'jumlah', 'bunga', 'biaya_adm', 'lunas', 'users.member_id', 'users.first_name', 'users.last_name', DB::raw("SUM(jumlah_bayar) as sudah_bayar"), DB::raw("COUNT(angsuran_ke) as sisa_angsuran"))
        ->groupBy('loans.id', 'tgl_pinjam', 'anggota_id', 'lama_angsuran', 'jumlah', 'bunga', 'biaya_adm', 'lunas', 'users.member_id', 'users.first_name', 'users.last_name')
        ->paginate(10);

        return view('loan-details.index', compact('dataAngsuran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loan-details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanDetailRequest $request)
    {
        
        LoanDetail::create($request->validated());

        return redirect()
            ->route('loan-details.index')
            ->with('success', __('The loanDetail was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoanDetail  $loanDetail
     * @return \Illuminate\Http\Response
     */
    public function show(LoanDetail $loanDetail)
    {
        $loanDetail->load('loan:id,tgl_pinjam', 'cash_type:id,nama', 'account_type:id,kd_aktiva', );

		return view('loan-details.show', compact('loanDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanDetail  $loanDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanDetail $loanDetail)
    {
        $loanDetail->load('loan:id,tgl_pinjam', 'cash_type:id,nama', 'account_type:id,kd_aktiva', );

		return view('loan-details.edit', compact('loanDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoanDetail  $loanDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoanDetailRequest $request, LoanDetail $loanDetail)
    {
        
        $loanDetail->update($request->validated());

        return redirect()
            ->route('loan-details.index')
            ->with('success', __('The loanDetail was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanDetail  $loanDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanDetail $loanDetail)
    {
        try {
            $loanDetail->delete();

            return redirect()
                ->route('loan-details.index')
                ->with('success', __('The loanDetail was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('loan-details.index')
                ->with('error', __("The loanDetail can't be deleted because it's related to another table."));
        }
    }
}
