<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashType;
use App\Http\Requests\{StoreCashTypeRequest, UpdateCashTypeRequest};
use Yajra\DataTables\Facades\DataTables;

class CashTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:jenis kas view')->only('index', 'show');
        $this->middleware('permission:jenis kas create')->only('create', 'store');
        $this->middleware('permission:jenis kas edit')->only('edit', 'update');
        $this->middleware('permission:jenis kas delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $cashTypes = CashType::query();

            return DataTables::of($cashTypes)
                ->addColumn('action', 'cash-types.include.action')
                ->toJson();
        }

        return view('cash-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cash-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashTypeRequest $request)
    {
        
        CashType::create($request->validated());

        return redirect()
            ->route('cash-types.index')
            ->with('success', __('The cashType was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashType  $cashType
     * @return \Illuminate\Http\Response
     */
    public function show(CashType $cashType)
    {
        return view('cash-types.show', compact('cashType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashType  $cashType
     * @return \Illuminate\Http\Response
     */
    public function edit(CashType $cashType)
    {
        return view('cash-types.edit', compact('cashType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashType  $cashType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashTypeRequest $request, CashType $cashType)
    {
        
        $cashType->update($request->validated());

        return redirect()
            ->route('cash-types.index')
            ->with('success', __('The cashType was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashType  $cashType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashType $cashType)
    {
        try {
            $cashType->delete();

            return redirect()
                ->route('cash-types.index')
                ->with('success', __('The cashType was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('cash-types.index')
                ->with('error', __("The cashType can't be deleted because it's related to another table."));
        }
    }
}
