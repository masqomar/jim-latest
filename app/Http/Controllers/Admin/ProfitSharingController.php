<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfitSharing;
use App\Http\Requests\{StoreProfitSharingRequest, UpdateProfitSharingRequest};
use Yajra\DataTables\Facades\DataTables;

class ProfitSharingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bagi hasil view')->only('index', 'show');
        $this->middleware('permission:bagi hasil create')->only('create', 'store');
        $this->middleware('permission:bagi hasil edit')->only('edit', 'update');
        $this->middleware('permission:bagi hasil delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $profitSharings = ProfitSharing::query();

            return DataTables::of($profitSharings)
                ->addColumn('action', 'profit-sharings.include.action')
                ->toJson();
        }

        return view('profit-sharings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profit-sharings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfitSharingRequest $request)
    {
        
        ProfitSharing::create($request->validated());

        return redirect()
            ->route('profit-sharings.index')
            ->with('success', __('The profitSharing was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfitSharing  $profitSharing
     * @return \Illuminate\Http\Response
     */
    public function show(ProfitSharing $profitSharing)
    {
        return view('profit-sharings.show', compact('profitSharing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfitSharing  $profitSharing
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfitSharing $profitSharing)
    {
        return view('profit-sharings.edit', compact('profitSharing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfitSharing  $profitSharing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfitSharingRequest $request, ProfitSharing $profitSharing)
    {
        
        $profitSharing->update($request->validated());

        return redirect()
            ->route('profit-sharings.index')
            ->with('success', __('The profitSharing was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfitSharing  $profitSharing
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfitSharing $profitSharing)
    {
        try {
            $profitSharing->delete();

            return redirect()
                ->route('profit-sharings.index')
                ->with('success', __('The profitSharing was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('profit-sharings.index')
                ->with('error', __("The profitSharing can't be deleted because it's related to another table."));
        }
    }
}
