<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KopProduct;
use App\Http\Requests\{StoreKopProductRequest, UpdateKopProductRequest};
use Yajra\DataTables\Facades\DataTables;

class KopProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:jenis barang view')->only('index', 'show');
        $this->middleware('permission:jenis barang create')->only('create', 'store');
        $this->middleware('permission:jenis barang edit')->only('edit', 'update');
        $this->middleware('permission:jenis barang delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $kopProducts = KopProduct::query()->orderBy('id', 'DESC');

            return DataTables::of($kopProducts)
                ->addColumn('action', 'kop-products.include.action')
                ->toJson();
        }

        return view('kop-products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kop-products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKopProductRequest $request)
    {
        
        KopProduct::create($request->validated());

        return redirect()
            ->route('kop-products.index')
            ->with('success', __('The kopProduct was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KopProduct  $kopProduct
     * @return \Illuminate\Http\Response
     */
    public function show(KopProduct $kopProduct)
    {
        return view('kop-products.show', compact('kopProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KopProduct  $kopProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(KopProduct $kopProduct)
    {
        return view('kop-products.edit', compact('kopProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KopProduct  $kopProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKopProductRequest $request, KopProduct $kopProduct)
    {
        
        $kopProduct->update($request->validated());

        return redirect()
            ->route('kop-products.index')
            ->with('success', __('The kopProduct was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KopProduct  $kopProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(KopProduct $kopProduct)
    {
        try {
            $kopProduct->delete();

            return redirect()
                ->route('kop-products.index')
                ->with('success', __('The kopProduct was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('kop-products.index')
                ->with('error', __("The kopProduct can't be deleted because it's related to another table."));
        }
    }
}
