<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JimpayVoucherRequest;
use App\Models\User;
use App\Models\UserTopup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TopupController extends Controller
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
            $topups = UserTopup::with('user:id,first_name,member_id')->where('note', 'Topup Cash');

            return DataTables::of($topups)
                ->addColumn('note', function ($row) {
                    return str($row->note)->limit(100);
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->first_name .  ' - '  . $row->user->member_id : '';
                })->addColumn('amount', function ($row) {
                    return 'Rp. ' . number_format($row->amount);
                })
                ->toJson();
        }

        return view('user-topups.index');
    }

    public function create()
    {
        return view('user-topups.create');
    }

    public function store(JimpayVoucherRequest $request)
    {
        $request->validated();
        DB::transaction(function () use ($request) {
                UserTopup::create([
                    'user_id' => $request->user_id,
                    'amount'    => $request->amount,
                    'date'      => now(),
                    'note' => 'Topup Cash',
                    'status' => 'Sukses',
                ]);

                $user = User::where('id', $request->user_id)->first();
                $user->deposit($request->amount, ['description' => 'Topup Cash']);
        });

        return redirect()
            ->route('user-topups.index')
            ->with('success', __('Topup voucher bulanan berhasil disimpan'));
    }
}
