<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigiflazzAccount;
use Illuminate\Http\Request;
use App\Models\PulsaList;
use Gonon\Digiflazz\Digiflazz;
use Gonon\Digiflazz\PriceList;

class PulsaController extends Controller
{
    public function index()
    {
        $userDigi = DigiflazzAccount::select('username')->first()->username;
        $apiKeyDigi = DigiflazzAccount::select('api_key')->first()->api_key;
        Digiflazz::initDigiflazz($userDigi, $apiKeyDigi);

        $priceList = PriceList::getPrePaid();
        foreach ($priceList as $list) {
            if ($list->seller_product_status == true) {
                $produkPulsa[] = array(
                    'brand' => $list->brand,
                    'kategori' => $list->category,
                    'nama_produk' => $list->product_name,
                    'harga' => $list->price,
                    'sku' => $list->buyer_sku_code,
                    'deskripsi' => $list->desc,
                );
            }
        }
        
        return view('pulsa.index', compact('produkPulsa'));
    }

    public function store(Request $request)
    {
        PulsaList::truncate();
        foreach ($request->brand as $key => $brand) {
          $data = new PulsaList();
          $data->brand = $brand;
          $data->kategori = $request->kategori[$key];
          $data->sku = $request->sku[$key];
          $data->nama_produk = $request->nama_produk[$key];
          $data->harga = $request->harga[$key];
          $data->margin = $request->margin[$key];
          $data->deskripsi = $request->deskripsi[$key];
          $data->save();
        }


        return redirect()->back()->with('success', __('Pulsa berhasil diupdate'));
    }
}
