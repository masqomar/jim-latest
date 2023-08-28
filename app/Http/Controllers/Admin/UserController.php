<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JimpayVoucherRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\SavingTransaction;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTopup;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class UserController extends Controller
{
    /**
     * Path for user avatar file.
     *
     * @var string
     */
    protected $avatarPath = '/uploads/images/avatars/';

    public function __construct()
    {
        $this->middleware('permission:user view')->only('index', 'show');
        $this->middleware('permission:user create')->only('create', 'store');
        $this->middleware('permission:user edit')->only('edit', 'update');
        $this->middleware('permission:user delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles:id,name')->where('type', 'user');

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

                ->addColumn('action', 'users.include.action')
                ->toJson();
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $attr = $request->validated() + (['country_code' => '62', 'type' => 'user']);

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
            ->route('users.index')
            ->with('success', __('Anggota berhasil disimpan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles:id,name');

        $setoranSimpanan = SavingTransaction::with('saving_type')->where('akun', 'Setoran')->where('anggota_id', $user->id)->get();
        $totalSetoran = SavingTransaction::with('saving_type')->where('akun', 'Setoran')->where('anggota_id', $user->id)->sum('jumlah');
        $setoranPenarikan = SavingTransaction::with('saving_type')->where('akun', 'Penarikan')->where('anggota_id', $user->id)->get();
        $totalPenarikan = SavingTransaction::with('saving_type')->where('akun', 'Penarikan')->where('anggota_id', $user->id)->sum('jumlah');
        $saldoSimpanan = $totalSetoran - $totalPenarikan;

        $topups = Transaction::where('payable_id', $user->id)->where('type', 'deposit')->get();
        $transaksiJimpay = Transaction::where('payable_id', $user->id)->where('type', 'withdraw')->get();
        $saldoJimpay = $user->balance;

        foreach ($setoranSimpanan as $setoran) {
            $dataSetoran[] = [
                'TRD' . str_pad($setoran->id, 5, '0', STR_PAD_LEFT),
                $setoran->tgl_transaksi->format('j F Y'),
                $setoran->saving_type->jns_simpan,
                number_format($setoran->jumlah),
                $setoran->keterangan ?? '-',
            ];
        }
        foreach ($setoranPenarikan as $penarikan) {
            $dataPenarikan[] = [
                'TRK' . str_pad($penarikan->id, 5, '0', STR_PAD_LEFT),
                $penarikan->tgl_transaksi->format('j F Y'),
                $penarikan->saving_type->jns_simpan,
                number_format($penarikan->jumlah),
                $penarikan->keterangan ?? '-',
            ];
        }
        foreach ($topups as $topup) {
            $dataTopup[] = [
                'TJD' . str_pad($topup->id, 5, '0', STR_PAD_LEFT),
                $topup->created_at->format('j F Y'),
                number_format($topup->amount),
                $topup->meta ?? '-',
            ];
        }
        foreach ($transaksiJimpay as $transaksi) {
            $dataTransaksi[] = [
                'TJK' . str_pad($transaksi->id, 5, '0', STR_PAD_LEFT),
                $transaksi->created_at->format('j F Y'),
                number_format(abs($transaksi->amount)),
                $transaksi->meta ?? '-',
            ];
        }
        $configSetoran = [
            'data' => $dataSetoran,
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null, null]
        ];
        $configPenarikan = [
            'data' => $dataPenarikan,
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null, null]
        ];
        $configTopup = [
            'data' => $dataTopup,
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null]
        ];
        $configTransaksi = [
            'data' => $dataTransaksi,
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null]
        ];

        // return json_encode($marginPembiayaan);
        return view('users.show', compact('user', 'configSetoran', 'configPenarikan', 'configTopup', 'configTransaksi', 'totalSetoran', 'totalPenarikan', 'saldoSimpanan', 'saldoJimpay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('roles:id,name');

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
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
            if ($user->avatar != null && file_exists($oldAvatar = public_path($this->avatarPath .
                $user->avatar))) {
                unlink($oldAvatar);
            }

            $attr['avatar'] = $filename;
        } else {
            $attr['avatar'] = $user->avatar;
        }

        switch (is_null($request->password)) {
            case true:
                unset($attr['password']);
                break;
            default:
                $attr['password'] = bcrypt($request->password);
                break;
        }

        $user->update($attr);

        $user->syncRoles($request->role);

        return redirect()
            ->route('users.index')
            ->with('success', __('Anggota berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->avatar != null && file_exists($oldAvatar = public_path($this->avatarPath . $user->avatar))) {
            unlink($oldAvatar);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', __('Anggota berhasil dihapus.'));
    }

    public function storeTopup(JimpayVoucherRequest $request)
    {
        $request->validated();
        DB::transaction(function () use ($request) {
            UserTopup::create([
                'user_id' => $request->user_id,
                'amount'    => $request->amount,
                'date'      => now(),
                'note' => $request->note,
                'status' => 'Sukses',
            ]);

            $user = User::where('id', $request->user_id)->first();
            $user->deposit($request->amount, ['description' => $request->note]);
        });

        return redirect()
            ->route('users.index')
            ->with('success', __('Topup berhasil disimpan'));
    }
}
