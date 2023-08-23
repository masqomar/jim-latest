<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission view')->only('index', 'show');
        $this->middleware('permission:permission create')->only('create', 'store');
        $this->middleware('permission:permission edit')->only('edit', 'update');
        $this->middleware('permission:permission delete')->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $permissions = Permission::query();

            return DataTables::of($permissions)
                ->addColumn('action', 'permissions.include.action')
                ->toJson();
        }


        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        Permission::create($request->validated());

        return redirect()
            ->route('permissions.index')
            ->with('success', __('Permission created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return redirect()
            ->route('permissions.index')
            ->with('success', __('Permission updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();

            return redirect()
                ->route('permissions.index')
                ->with('success', __('Permission deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('permissions.index')
                ->with('error', __('The Permission can`t be deleted because it is related to another table.'));
        }
    }
}
