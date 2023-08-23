<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JimpayVoucherRequest;
use App\Models\User;
use App\Models\UserTopup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JimpayVoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:topup view')->only('index', 'show');
        $this->middleware('permission:topup create')->only('create', 'store');
        $this->middleware('permission:topup edit')->only('edit', 'update');
        $this->middleware('permission:topup delete')->only('delete');
    }
    
    public function index()
    {
        if (request()->ajax()) {
            $vouchers = UserTopup::with('user:id,first_name,member_id')->where('note', 'Voucher Bulanan')->orderBy('id', 'DESC');

            return DataTables::of($vouchers)
                ->addColumn('note', function ($row) {
                    return str($row->note)->limit(100);
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->first_name .  ' - '  . $row->user->member_id : '';
                })->addColumn('amount', function ($row) {
                    return 'Rp. ' . number_format($row->amount);
                })
                ->toJson();
        }

        return view('jimpay-vouchers.index');
    }

    public function create()
    {
        return view('jimpay-vouchers.create');
    }

    public function store(JimpayVoucherRequest $request)
    {
        $request->validated();
        DB::transaction(function () use ($request) {
            $id = $request->user_id;
            for ($i = 0; $i < count($id); $i++) {
                UserTopup::create([
                    'user_id' => $id[$i],
                    'amount'    => $request->amount,
                    'date'      => now(),
                    'note' => 'Voucher Bulanan',
                    'status' => 'Sukses',
                ]);

                $user = User::where('id', $id[$i])->first();
                $user->deposit($request->amount, ['description' => 'Voucher Bulanan']);

            }
        });

        return redirect()
            ->route('jimpay-vouchers.index')
            ->with('success', __('Topup voucher bulanan berhasil disimpan'));
    }
}
