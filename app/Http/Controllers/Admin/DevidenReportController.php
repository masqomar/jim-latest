<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevidenReportController extends Controller
{
    public function index()
    {
        $pembagianShu = User::select('id', 'first_name', 'member_id')->where('status', 1)->paginate(10);
         $setoranSiWajib = DB::table('saving_transactions') 
        ->leftJoin('users', 'users.id', 'saving_transactions.anggota_id')
        ->select('saving_transactions.anggota_id', DB::raw("SUM(saving_transactions.jumlah) as total_setoran_wajib"))
        ->groupBy('saving_transactions.anggota_id')
        ->where('saving_transactions.jenis_id', 41)
        ->where('saving_transactions.akun', 'Setoran')
        ->paginate(10);
        $penarikanSiWajib = DB::table('saving_transactions') 
        ->leftJoin('users', 'users.id', 'saving_transactions.anggota_id')
        ->select('saving_transactions.anggota_id', DB::raw("SUM(saving_transactions.jumlah) as total_penarikan_wajib"))
        ->groupBy('saving_transactions.anggota_id')
        ->where('saving_transactions.jenis_id', 41)
        ->where('saving_transactions.akun', 'Penarikan')
        ->paginate(10);
        $setoranSisuka = DB::table('saving_transactions') 
        ->leftJoin('users', 'users.id', 'saving_transactions.anggota_id')
        ->select('saving_transactions.anggota_id', DB::raw("SUM(saving_transactions.jumlah) as total_setoran_suka"))
        ->groupBy('saving_transactions.anggota_id')
        ->where('saving_transactions.jenis_id', 32)
        ->where('saving_transactions.akun', 'Setoran')
        ->paginate(10); 

        // $testQuery = User::with('simpanan')->where('status', 1)->get();

        // return json_encode($testQuery);
        return view('deviden-reports.index', compact('pembagianShu'));
    }
}
