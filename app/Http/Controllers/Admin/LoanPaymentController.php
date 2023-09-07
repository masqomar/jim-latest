<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanPaymentRequest;
use App\Models\CashType;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LoanPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bayar angsuran view')->only('index', 'show');
        $this->middleware('permission:bayar angsuran create')->only('create', 'store');
        $this->middleware('permission:bayar angsuran edit')->only('edit', 'update');
        $this->middleware('permission:bayar angsuran delete')->only('delete');
    }

    public function index()
    {
        if (request()->ajax()) {
            $angsuran = Loan::with('user:id,first_name,member_id')->where('lunas', 'Belum');

            return DataTables::of($angsuran)
                ->addColumn('kode_transaksi', function ($row) {
                    return 'TPJ' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
                })->addColumn('tgl_pinjam', function ($row) {
                    return date('j \\ F Y', strtotime($row->tgl_pinjam));
                })->addColumn('first_name', function ($row) {
                    return $row->user ? $row->user->first_name : '-';
                })->addColumn('member_id', function ($row) {
                    return $row->user ? $row->user->member_id : '-';
                })->addColumn('pokok_pinjaman', function ($row) {
                    return 'Rp. ' . number_format($row->jumlah);
                })->addColumn('lama_pinjaman', function ($row) {
                    return $row->lama_angsuran . ' bulan';
                })->addColumn('angsuran_pokok', function ($row) {
                    return 'Rp. ' . number_format($row->jumlah / 6);
                })->addColumn('margin', function ($row) {
                    return 'Rp. ' . number_format($row->biaya_adm);
                })->addColumn('angsuran_bulanan', function ($row) {
                    return 'Rp. ' . number_format($row->jumlah / 6 + $row->biaya_adm);
                })->addColumn('action', 'loan-payments.include.action')
                ->toJson();
        }

        return view('loan-payments.index');
    }

    public function show($id)
    {
        $pinjaman = Loan::find($id);
        $angsuran = LoanDetail::where('pinjam_id', $id)->get();
        foreach ($angsuran as $angsur) {
            $dataAngsuran[] = [
                'TPJ' . str_pad($angsur->id, 5, '0', STR_PAD_LEFT),
                $angsur->tgl_bayar->format('j F Y'),
                $angsur->angsuran_ke,
                number_format($angsur->jumlah_bayar),
                $angsur->keterangan ?? '-',
            ];
        }
        $configAngsuran = [
            'data' => $dataAngsuran ?? [null, null, null, null, null],
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null, null]
        ];

        return view('loan-payments.show', compact('pinjaman', 'angsuran', 'configAngsuran'));
    }

    public function bayar(LoanPaymentRequest $request)
    {
        LoanDetail::create($request->validated() + (['denda_rp' => 0, 'terlambat' => 0, 'dk' => 'D', 'jns_trans' => 48]));

        return back()->with('success', __('Angsuran berhasil disimpan.'));
    }
}
