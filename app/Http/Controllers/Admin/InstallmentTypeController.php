<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstallmentType;
use App\Http\Requests\{StoreInstallmentTypeRequest, UpdateInstallmentTypeRequest};
use Yajra\DataTables\Facades\DataTables;

class InstallmentTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tenor view')->only('index', 'show');
        $this->middleware('permission:tenor create')->only('create', 'store');
        $this->middleware('permission:tenor edit')->only('edit', 'update');
        $this->middleware('permission:tenor delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $installmentTypes = InstallmentType::query();

            return DataTables::of($installmentTypes)
                ->addColumn('action', 'installment-types.include.action')
                ->toJson();
        }

        return view('installment-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('installment-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstallmentTypeRequest $request)
    {
        
        InstallmentType::create($request->validated());

        return redirect()
            ->route('installment-types.index')
            ->with('success', __('The installmentType was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstallmentType  $installmentType
     * @return \Illuminate\Http\Response
     */
    public function show(InstallmentType $installmentType)
    {
        return view('installment-types.show', compact('installmentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstallmentType  $installmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(InstallmentType $installmentType)
    {
        return view('installment-types.edit', compact('installmentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstallmentType  $installmentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstallmentTypeRequest $request, InstallmentType $installmentType)
    {
        
        $installmentType->update($request->validated());

        return redirect()
            ->route('installment-types.index')
            ->with('success', __('The installmentType was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstallmentType  $installmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstallmentType $installmentType)
    {
        try {
            $installmentType->delete();

            return redirect()
                ->route('installment-types.index')
                ->with('success', __('The installmentType was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('installment-types.index')
                ->with('error', __("The installmentType can't be deleted because it's related to another table."));
        }
    }
}
