<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Http\Requests\{StoreLoanRequest, UpdateLoanRequest};
use App\Models\KopProduct;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pinjaman view')->only('index', 'show');
        $this->middleware('permission:pinjaman create')->only('create', 'store');
        $this->middleware('permission:pinjaman edit')->only('edit', 'update');
        $this->middleware('permission:pinjaman delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPinjaman = DB::table('loans')
        ->leftJoin('loan_details', 'loan_details.pinjam_id', 'loans.id')
        ->leftJoin('kop_products', 'kop_products.id', 'loans.barang_id')
        ->leftJoin('users', 'users.id', 'loans.anggota_id')
        ->select('loans.id', 'tgl_pinjam', 'anggota_id', 'barang_id', 'lama_angsuran', 'jumlah', 'bunga', 'biaya_adm', 'lunas', 'users.member_id', 'users.first_name', 'users.last_name', 'kop_products.nm_barang', 'kop_products.harga', DB::raw("SUM(jumlah_bayar) as sudah_bayar"), DB::raw("COUNT(angsuran_ke) as sisa_angsuran"))
        ->groupBy('loans.id', 'tgl_pinjam', 'anggota_id', 'barang_id', 'lama_angsuran', 'jumlah', 'bunga', 'biaya_adm', 'lunas', 'users.member_id', 'users.first_name', 'users.last_name', 'kop_products.nm_barang', 'kop_products.harga')
        ->paginate(5);

        return view('loans.index', compact('dataPinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        
        Loan::create($request->validated() + (['lunas' => 'Belum', 'dk' => 'K', 'jns_trans' => 7]));

        // $jmlBarang = KopProduct::select('jml_brg')->where('id', $request->barang_id)->first()->jml_brg;
        // $kurangi = $jmlBarang - 1;
        // KopProduct::where('id', $request->barang_id)->update(['jml_brg', $kurangi]);
        
        return redirect()
            ->route('loans.index')
            ->with('success', __('Pinjaman baru berhasil disimpan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        $loan->load('user:id,first_name', 'kop_product:id,nm_barang', 'cash_type:id,nama', 'cash_type:id,nama', );

		return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        $loan->load('user:id,first_name', 'kop_product:id,nm_barang', 'cash_type:id,nama', 'cash_type:id,nama', );

		return view('loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        
        $loan->update($request->validated());

        return redirect()
            ->route('loans.index')
            ->with('success', __('The loan was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        try {
            $loan->delete();

            return redirect()
                ->route('loans.index')
                ->with('success', __('The loan was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('loans.index')
                ->with('error', __("The loan can't be deleted because it's related to another table."));
        }
    }
}
