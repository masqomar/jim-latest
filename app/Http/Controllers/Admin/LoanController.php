<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Http\Requests\{StoreLoanRequest, UpdateLoanRequest};
use App\Models\KopProduct;
use App\Models\LoanDetail;
use App\Models\User;
use App\Models\ViewPinjaman;
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
        
        $dataPinjaman = ViewPinjaman::get();
        foreach ($dataPinjaman as $pinjaman) {
            $pinjamanAnggota[] = [
                'PJ' . str_pad($pinjaman->id, 5, '0', STR_PAD_LEFT),
                $pinjaman->tgl_pinjam->format('d-m-Y'),
                User::select('id', 'member_id', 'first_name')->where('id', $pinjaman->anggota_id)->first()->member_id. '<br>'.
                User::select('id', 'member_id', 'first_name')->where('id', $pinjaman->anggota_id)->first()->first_name,
                'Nama Barang : ' . KopProduct::where('id', $pinjaman->barang_id)->first()->nm_barang. '<br>'.
                'Harga Barang : ' . number_format(KopProduct::where('id', $pinjaman->barang_id)->first()->harga). '<br>'.
                'Lama Angsuran : ' . $pinjaman->lama_angsuran. '<br>'.
                'Pokok Angsuran : ' . number_format($pinjaman->pokok_angsuran). '<br>'.
                'Bunga : ' . $pinjaman->bunga. '<br>'.
                'Margin : ' . number_format($pinjaman->biaya_adm),
                'Jumlah Angsuran : ' . number_format($pinjaman->ags_per_bulan). '<br>'.
                'Total Tagihan : ' . number_format($pinjaman->tagihan). '<br>'.
                'Sudah Dibayar : '. number_format(LoanDetail::where('pinjam_id', $pinjaman->id)->sum('jumlah_bayar')). '<br>'.
                'Sisa Angsuran : '. number_format($pinjaman->tagihan - LoanDetail::where('pinjam_id', $pinjaman->id)->sum('jumlah_bayar')). '<br>'.
                'sisatagihan',
                $pinjaman->lunas,
            ] ;
        }

        $config = [
            'data' => $pinjamanAnggota,
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null, null, null]
        ];

        return view('loans.index', compact('config'));
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
