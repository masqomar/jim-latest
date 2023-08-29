<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class UserSavingTransactionController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('type', 'user')->get();

        if (!empty($request->tahun)) {
            foreach ($users as $user) {
                $dataSimpanan[] = [
                    $user->member_id,
                    $user->first_name . ' ' . '(Setor)',
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '01')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '02')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '03')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '04')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '05')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '06')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '07')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '08')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '09')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '10')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '11')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '12')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                ];
                $dataSimpanan[] = [
                    $user->member_id,
                    $user->first_name . '   (Tarik)',
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '01')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '02')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '03')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '04')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '05')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '06')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '07')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '08')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '09')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '10')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '11')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '12')->whereYear('tgl_transaksi', $request->tahun)->sum('jumlah')),
                ];
            }
        } else {
            foreach ($users as $user) {
                $dataSimpanan[] = [
                    $user->member_id,
                    $user->first_name . ' ' . '(Setor)',
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '01')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '02')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '03')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '04')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '05')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '06')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '07')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '08')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '09')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '10')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '11')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Setoran')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '12')->sum('jumlah')),
                ];
                $dataSimpanan[] = [
                    $user->member_id,
                    $user->first_name . '   (Tarik)',
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '01')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '02')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '03')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '04')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '05')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '06')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '07')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '08')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '09')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '10')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '11')->sum('jumlah')),
                    number_format(SavingTransaction::where('anggota_id', $user->id)->where('akun', 'Penarikan')->where('jenis_id', 32)->whereMonth('tgl_transaksi', '12')->sum('jumlah')),
                ];
            }
        }
        $config = [
            'data' => $dataSimpanan,
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null, null, null, null, null, null, null, null],
        ];

        // return json_encode($dataSimpanan);
        return view('user-saving-transactions.index', compact('config'));
    }
}
