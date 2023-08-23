<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingType;
use App\Http\Requests\{StoreSavingTypeRequest, UpdateSavingTypeRequest};
use Yajra\DataTables\Facades\DataTables;

class SavingTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:jenis simpanan view')->only('index', 'show');
        $this->middleware('permission:jenis simpanan create')->only('create', 'store');
        $this->middleware('permission:jenis simpanan edit')->only('edit', 'update');
        $this->middleware('permission:jenis simpanan delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $savingTypes = SavingType::query();

            return DataTables::of($savingTypes)
                ->addColumn('action', 'saving-types.include.action')
                ->toJson();
        }

        return view('saving-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('saving-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSavingTypeRequest $request)
    {
        
        SavingType::create($request->validated());

        return redirect()
            ->route('saving-types.index')
            ->with('success', __('The savingType was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SavingType  $savingType
     * @return \Illuminate\Http\Response
     */
    public function show(SavingType $savingType)
    {
        return view('saving-types.show', compact('savingType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SavingType  $savingType
     * @return \Illuminate\Http\Response
     */
    public function edit(SavingType $savingType)
    {
        return view('saving-types.edit', compact('savingType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SavingType  $savingType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavingTypeRequest $request, SavingType $savingType)
    {
        
        $savingType->update($request->validated());

        return redirect()
            ->route('saving-types.index')
            ->with('success', __('The savingType was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SavingType  $savingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SavingType $savingType)
    {
        try {
            $savingType->delete();

            return redirect()
                ->route('saving-types.index')
                ->with('success', __('The savingType was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('saving-types.index')
                ->with('error', __("The savingType can't be deleted because it's related to another table."));
        }
    }
}
