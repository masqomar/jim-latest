<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use App\Models\ViewPinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserTransactionController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'user')->get();

        foreach ($users as $anggota) {
            $setoran_sim_pokok = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 40)->where('akun', 'setoran')->sum('jumlah');
            $penarikan_sim_pokok = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 40)->where('akun', 'Penarikan')->sum('jumlah');
            $saldoSimPokok = $setoran_sim_pokok - $penarikan_sim_pokok;

            $setoran_sim_wajib = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 41)->where('akun', 'setoran')->sum('jumlah');
            $penarikan_sim_wajib = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 41)->where('akun', 'Penarikan')->sum('jumlah');
            $saldoSimWajib = $setoran_sim_wajib - $penarikan_sim_wajib;

            $setoran_sim_sukarela = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'setoran')->sum('jumlah');
            $penarikan_sim_sukarela = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->sum('jumlah');
            $saldoSimSukarela = $setoran_sim_sukarela - $penarikan_sim_sukarela;
            $totalSaldoSimpanan = $saldoSimPokok + $saldoSimWajib + $saldoSimSukarela;

            $pinjaman = Loan::where('anggota_id', $anggota->id)->where('lunas', 'Belum')->sum('jumlah') + Loan::where('anggota_id', $anggota->id)->where('lunas', 'Belum')->sum('biaya_adm') * 6;
            $tagihan = ViewPinjaman::where('anggota_id', $anggota->id)->where('lunas', 'Belum')->sum('biaya_adm') * 6 + ViewPinjaman::where('anggota_id', $anggota->id)->where('lunas', 'Belum')->sum('pokok_angsuran') * 6;

            $jumlahPinjaman = Loan::where('anggota_id', $anggota->id)->count();
            $pinjamanLunas = Loan::where('anggota_id', $anggota->id)->where('lunas', 'Lunas')->count();

            $dataTransaksi[] = [
                $anggota->id,

                'ID Anggota : ' . ' ' . $anggota->member_id . '<br>' .
                    'Nama Anggota : ' . ' ' . $anggota->first_name . '<br>' .
                    'Email : ' . ' ' . $anggota->email . '<br>' .
                    'Telepon : ' . ' ' . $anggota->mobile,

                'Simpanan Pokok : ' . ' ' . number_format($saldoSimPokok) . '<br>' .
                    'Simpanan Wajib : ' . ' ' . number_format($saldoSimWajib) . '<br>' .
                    'Simpanan Sukarela : ' . ' ' . number_format($saldoSimSukarela) . '<br>' .
                    'Total Simpanan : ' . ' ' . number_format($totalSaldoSimpanan),

                'Total Pinjaman : ' . ' ' . number_format($pinjaman) . '<br>' .
                    'Total Tagihan : ' . ' ' . number_format($tagihan) . '<br>' .
                    'Jumlah Pinjaman : ' . ' ' . $jumlahPinjaman . '<br>' .
                    'Pinjaman Lunas : ' . ' ' . $pinjamanLunas,
            ];
        }

        $config = [
            'data' => $dataTransaksi ?? [null, null, null, null],
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null],
        ];

        return view('user-transactions.index', compact('config'));
    }
}
