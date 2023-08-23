<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use App\Http\Requests\{StoreAccountTypeRequest, UpdateAccountTypeRequest};
use Yajra\DataTables\Facades\DataTables;

class AccountTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:jenis akun view')->only('index', 'show');
        $this->middleware('permission:jenis akun create')->only('create', 'store');
        $this->middleware('permission:jenis akun edit')->only('edit', 'update');
        $this->middleware('permission:jenis akun delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $accountTypes = AccountType::query();

            return DataTables::of($accountTypes)
                ->addColumn('action', 'account-types.include.action')
                ->toJson();
        }

        return view('account-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountTypeRequest $request)
    {
        
        AccountType::create($request->validated());

        return redirect()
            ->route('account-types.index')
            ->with('success', __('The accountType was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function show(AccountType $accountType)
    {
        return view('account-types.show', compact('accountType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountType $accountType)
    {
        return view('account-types.edit', compact('accountType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountTypeRequest $request, AccountType $accountType)
    {
        
        $accountType->update($request->validated());

        return redirect()
            ->route('account-types.index')
            ->with('success', __('The accountType was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountType $accountType)
    {
        try {
            $accountType->delete();

            return redirect()
                ->route('account-types.index')
                ->with('success', __('The accountType was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('account-types.index')
                ->with('error', __("The accountType can't be deleted because it's related to another table."));
        }
    }
}
