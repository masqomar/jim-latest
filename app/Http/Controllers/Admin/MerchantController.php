<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMerchantRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Image;

class MerchantController extends Controller
{
    protected $avatarPath = '/uploads/images/avatars/';

    // public function __construct()
    // {
    //     $this->middleware('permission:mitra view')->only('index', 'show');
    //     $this->middleware('permission:mitra create')->only('create', 'store');
    //     $this->middleware('permission:mitra edit')->only('edit', 'update');
    //     $this->middleware('permission:mitra delete')->only('destroy');
    // }

    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles:id,name')->where('type', 'store');

            return DataTables::of($users)
                ->addColumn('role', function ($row) {
                    return $row->getRoleNames()->toArray() !== [] ? $row->getRoleNames()[0] : '-';
                })
                ->addColumn('avatar', function ($row) {
                    if ($row->avatar == null) {
                        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($row->email))) . '&s=500';
                    }
                    return asset($this->avatarPath . $row->avatar);
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'Aktif';
                    }
                    return 'Tidak Aktif';
                })

                ->addColumn('action', 'merchants.include.action')
                ->toJson();
        }

        return view('merchants.index');
    }

    public function create()
    {
        return view('merchants.create');
    }

    public function store(UserRequest $request)
    {
        $attr = $request->validated() + (['country_code' => '62', 'type' => 'store']);

        if ($request->file('avatar') && $request->file('avatar')->isValid()) {

            $filename = $request->file('avatar')->hashName();

            if (!file_exists($folder = public_path($this->avatarPath))) {
                mkdir($folder, 0777, true);
            }

            Image::make($request->file('avatar')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($this->avatarPath . $filename);

            $attr['avatar'] = $filename;
        }

        $attr['password'] = bcrypt($request->password);

        $user = User::create($attr);

        $user->assignRole($request->role);

        return redirect()
            ->route('merchants.index')
            ->with('success', __('Mitra baru berhasil disimpan.'));
    }

    public function show(User $merchant)
    {
        $merchant->load('roles:id,name');
        $saldo = Transaction::where('payable_id', $merchant->id)->where('type', 'deposit')->sum('amount');
        $pencairan = Transaction::where('payable_id', $merchant->id)->where('type', 'withdraw')->sum('amount');
        $semuaTransaksi = Transaction::where('payable_id', $merchant->id)->get();

        foreach ($semuaTransaksi as $transaksi) {
            $transaksiMerchant [] = [
                $transaksi->id,
                $transaksi->created_at->format('d-m-Y'),
                number_format($transaksi->amount),
                $transaksi->meta,
            ];
        }

        $config = [
            'data' => $transaksiMerchant ?? [null, null, null, null],
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null],
        ];
        
        return view('merchants.show', compact('merchant', 'saldo', 'pencairan', 'config'));
    }

    public function edit(User $merchant)
    {
        $merchant->load('roles:id,name');

        return view('merchants.edit', compact('merchant'));
    }

    public function update(UpdateMerchantRequest $request, User $merchant)
    {
        $attr = $request->validated() + (['status' => $request->status]);

        if ($request->file('avatar') && $request->file('avatar')->isValid()) {

            $filename = $request->file('avatar')->hashName();

            // if folder dont exist, then create folder
            if (!file_exists($folder = public_path($this->avatarPath))) {
                mkdir($folder, 0777, true);
            }

            // Intervention Image
            Image::make($request->file('avatar')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($this->avatarPath) . $filename);

            // delete old avatar from storage
            if ($merchant->avatar != null && file_exists($oldAvatar = public_path($this->avatarPath .
                $merchant->avatar))) {
                unlink($oldAvatar);
            }

            $attr['avatar'] = $filename;
        } else {
            $attr['avatar'] = $merchant->avatar;
        }

        switch (is_null($request->password)) {
            case true:
                unset($attr['password']);
                break;
            default:
                $attr['password'] = bcrypt($request->password);
                break;
        }

        $merchant->update($attr);

        $merchant->syncRoles($request->role);

        return redirect()
            ->route('merchants.index')
            ->with('success', __('Mitra berhasil diupdate.'));
    }

    public function destroy(User $merchant)
    {
        if ($merchant->avatar != null && file_exists($oldAvatar = public_path($this->avatarPath . $merchant->avatar))) {
            unlink($oldAvatar);
        }

        $merchant->delete();

        return redirect()
            ->route('merchants.index')
            ->with('success', __('Mitra berhasil dihapus.'));
    }
}
