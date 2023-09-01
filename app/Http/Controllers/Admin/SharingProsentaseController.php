<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfitSharing;
use App\Models\SavingTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SharingProsentaseController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('type', 'user')->get();
        foreach ($users as $anggota) {
            $dataAnggota[] = [
                $anggota->id,
                $anggota->member_id . '<br>' . $anggota->first_name,
                'SiPoJib: 0 / 0' . '<br>' .
                    'SiSuka: 0 / 0',
                '0 / 0',
                '0 / 0',
                '0 / 0',
            ];
        }
        $config = [
            'data' => $dataAnggota,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, null],
        ];
        return view('sharing-prosentase.index', compact('config'));
    }

    public function filter(Request $request)
    {
        $users = User::where('type', 'user')->get();
        foreach ($users as $anggota) {
            $totalPinjaman = DB::table('v_hitung_pinjaman')->whereBetween('tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])->sum('jumlah');
            $totalAngsuran = DB::table('loan_details')->leftJoin('loans', 'loans.id', 'loan_details.pinjam_id')->whereBetween('loans.tgl_pinjam', [$request->dari_tanggal, $request->sampai_tanggal])->sum('jumlah_bayar');
            $pendapatanPinjaman = $totalAngsuran - $totalPinjaman;

            $akunDebet = DB::table('account_types')->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')->where('aktif', 'Y')->where('laba_rugi', 'PENDAPATAN')->whereBetween('v_transaksi.tgl', [$request->dari_tanggal, $request->sampai_tanggal])->sum('debet');
            $akunKredit = DB::table('account_types')->leftJoin('v_transaksi', 'v_transaksi.transaksi', 'account_types.id')->where('aktif', 'Y')->where('laba_rugi', 'BIAYA')->whereBetween('v_transaksi.tgl', [$request->dari_tanggal, $request->sampai_tanggal])->sum('kredit');

            $shuSebelumPajak = $akunDebet + $pendapatanPinjaman - $akunKredit;
            $pajak = round(ProfitSharing::select('opsi_val')->where('opsi_key', 'pjk_pph')->first()->opsi_val / 100 * $shuSebelumPajak);
            $shuSetelahPajak = $shuSebelumPajak - $pajak;
            $shuAnggota = round(ProfitSharing::select('opsi_val')->where('opsi_key', 'jasa_anggota')->first()->opsi_val / 100 * $shuSetelahPajak);

            $shuSiPojib = round(ProfitSharing::select('opsi_val')->where('opsi_key', 'jasa_modal')->first()->opsi_val / 100 * $shuAnggota);
            $shuSiSuka = round(ProfitSharing::select('opsi_val')->where('opsi_key', 'jasa_modal_suka')->first()->opsi_val / 100 * $shuAnggota);
            $shuPinjaman = round(ProfitSharing::select('opsi_val')->where('opsi_key', 'jasa_usaha_pembiayaan')->first()->opsi_val / 100 * $shuAnggota);
            $shuJimmart = round(ProfitSharing::select('opsi_val')->where('opsi_key', 'jasa_usaha_jimmart')->first()->opsi_val / 100 * $shuAnggota);

            $setoranSiPokok = SavingTransaction::where('anggota_id', $anggota->id)->where('jenis_id', 40)->where('akun', 'Setoran')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');
            $penarikanSiPokok = SavingTransaction::where('anggota_id', $anggota->id)->where('jenis_id', 40)->where('akun', 'Penarikan')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');
            $setoranSiWajib = SavingTransaction::where('anggota_id', $anggota->id)->where('jenis_id', 41)->where('akun', 'Setoran')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');
            $penarikanSiWajib = SavingTransaction::where('anggota_id', $anggota->id)->where('jenis_id', 41)->where('akun', 'Penarikan')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');
            $setoranSiSuka = SavingTransaction::where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');
            $penarikanSiSuka = SavingTransaction::where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');

            $totalSetoranSiPoJib = SavingTransaction::where('jenis_id', 40)->where('akun', 'Setoran')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah') + SavingTransaction::where('jenis_id', 41)->where('akun', 'Setoran')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');
            $totalPenarikanSiPoJib = SavingTransaction::where('jenis_id', 40)->where('akun', 'Penarikan')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah') + SavingTransaction::where('jenis_id', 41)->where('akun', 'Penarikan')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');
            $saldoSiPojib = $totalSetoranSiPoJib - $totalPenarikanSiPoJib;
            $saldoSisuka = SavingTransaction::where('jenis_id', 32)->where('akun', 'Setoran')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah') - SavingTransaction::where('jenis_id', 32)->where('akun', 'Penarikan')->whereDate('tgl_transaksi', '<=', [$request->sampai_tanggal])->sum('jumlah');

            $siPoJib = $setoranSiPokok - $penarikanSiPokok + $setoranSiWajib - $penarikanSiWajib;
            $shuSiPoJibdibagi = $siPoJib / $saldoSiPojib * $shuSiPojib;
            
            $sisuka = $setoranSiSuka - $penarikanSiSuka;
            $shuSisukadibagi = $sisuka / $saldoSisuka * $shuSiSuka;

            $pinjamanAnggota = DB::table('loan_details')->leftJoin('loans', 'loans.id', 'loan_details.pinjam_id')->where('loans.anggota_id', $anggota->id)->whereBetween('tgl_bayar', [$request->dari_tanggal, $request->sampai_tanggal])->sum('jumlah_bayar');
            $shuPinjamanAnggota = $pinjamanAnggota / $totalAngsuran * $shuPinjaman;

            $transaksiJimpay = DB::table('transactions')->where('type', 'withdraw')->whereBetween('created_at', [$request->dari_tanggal, $request->sampai_tanggal])->sum('amount');
            $transaksiJimpayAnggota = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'withdraw')->whereBetween('created_at', [$request->dari_tanggal, $request->sampai_tanggal])->sum('amount');
            $shuTransaksiJimpay = $transaksiJimpayAnggota / $transaksiJimpay * $shuJimmart;

            $dataAnggota[] = [
                $anggota->id,
                $anggota->member_id . '<br>' . $anggota->first_name,
                'SiPoJib: ' . number_format($siPoJib) . ' / ' . number_format(round($shuSiPoJibdibagi)) . '<br>' .
                'SiSuka: ' . number_format(round($setoranSiSuka - $penarikanSiSuka)) . ' / ' . number_format(round($shuSisukadibagi)). '<br>' .
                'Total SHU Simpapan: ' . number_format($shuSiPoJibdibagi + $shuSisukadibagi),
                number_format($pinjamanAnggota) . ' / ' . number_format(round($shuPinjamanAnggota)), // Pembiayaan
                number_format(abs($transaksiJimpayAnggota)) . ' / ' . number_format(round($shuTransaksiJimpay)), // JImpay
                number_format($shuSiPoJibdibagi + $shuSisukadibagi + $shuPinjamanAnggota + $shuTransaksiJimpay), // SHU dibagikan
                // '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'
            ];
        }
        $config = [
            'data' => $dataAnggota,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, null],
        ];

        // return json_encode($dataAnggota);
        return view('sharing-prosentase.index', compact('config'));
    }
}
