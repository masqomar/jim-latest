<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
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
        
        return view('users.show', compact('user'));
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
}

