<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JimpayTransactionController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('type', 'user')->get();
        if (!empty($request->tahun)) {
            foreach ($users as $user) {
                $transaksiJimpay[] = [
                    $user->member_id,
                    $user->first_name,
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '01')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '02')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '03')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '04')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '05')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '06')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '07')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '08')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '09')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '10')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '11')->whereYear('created_at', $request->tahun)->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '12')->whereYear('created_at', $request->tahun)->sum('amount'))),
                 ];
            }
        } else {
            foreach ($users as $user) {
                $transaksiJimpay[] = [
                    $user->member_id,
                    $user->first_name,
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '01')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '02')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '03')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '04')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '05')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '06')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '07')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '08')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '09')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '10')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '11')->sum('amount'))),
                    number_format(abs(Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->whereMonth('created_at', '12')->sum('amount'))),
                 ];
            }
        }
        $config = [
            'data' => $transaksiJimpay,
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null, null, null, null, null, null, null, null],
        ];

        // return json_encode($transaksiJimpay);
        return view('jimpay-transactions.index', compact('config'));
    }
}
