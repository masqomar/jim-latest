<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SetoranSimpananImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnggotaExport;
use App\Exports\KasKeluarExport;
use App\Exports\KasMasukExport;
use App\Exports\KasTransferExport;
use App\Exports\PenarikanSimpananExport;
use App\Exports\SetoranSimpananExport;
use App\Imports\KasKeluarImport;
use App\Imports\KasMasukImport;
use App\Imports\KasTransferImport;
use App\Imports\PenarikanSimpananImport;

class ExportImportController extends Controller
{
    public function exportPenarikanSimpanan()
    {
        return (new PenarikanSimpananExport)->download('Penarikan Simpanan.xlsx');
    }

    public function exportSetoranSimpanan()
    {
        return (new SetoranSimpananExport)->download('Setoran Simpanan.xlsx');
    }

    public function exportAnggota()
    {
        return (new AnggotaExport)->download('Data Anggota.xlsx');
    }

    public function exportKasTransfer()
    {
        return (new KasTransferExport)->download('Data Transfer Kas.xlsx');
    }

    public function exportKasMasuk()
    {
        return (new KasMasukExport)->download('Data Kas Masuk.xlsx');
    }

    public function exportKasKeluar()
    {
        return (new KasKeluarExport)->download('Data Kas Keluar.xlsx');
    }

    public function setoranImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new SetoranSimpananImport(), storage_path('app/public/excel/' . $nama_file));

        //remove from server
        Storage::delete($path);

        if ($import) {
            //redirect            
            return redirect()->route('deposits.index')->with('success', __('Data Berhasil Diimport!'));
        } else {
            //redirect
            return redirect()->route('deposits.index')->with('success', __('Data gagal Diimport!'));
        }
    }

    public function penarikanImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new PenarikanSimpananImport(), storage_path('app/public/excel/' . $nama_file));

        //remove from server
        Storage::delete($path);

        if ($import) {
            //redirect            
            return redirect()->route('withdrawals.index')->with('success', __('Data Berhasil Diimport!'));
        } else {
            //redirect
            return redirect()->route('withdrawals.index')->with('success', __('Data gagal Diimport!'));
        }
    }

    public function pemasukanKasImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new KasMasukImport(), storage_path('app/public/excel/' . $nama_file));

        //remove from server
        Storage::delete($path);

        if ($import) {
            //redirect            
            return redirect()->route('cash-ins.index')->with('success', __('Data Berhasil Diimport!'));
        } else {
            //redirect
            return redirect()->route('cash-ins.index')->with('error', __('Data gagal Diimport!'));
        }
    }

    public function pengeluaranKasImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new KasKeluarImport(), storage_path('app/public/excel/' . $nama_file));

        //remove from server
        Storage::delete($path);

        if ($import) {
            //redirect            
            return redirect()->route('cash-outs.index')->with('success', __('Data Berhasil Diimport!'));
        } else {
            //redirect
            return redirect()->route('cash-outs.index')->with('error', __('Data gagal Diimport!'));
        }
    }

    public function transferKasImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new KasTransferImport(), storage_path('app/public/excel/' . $nama_file));

        //remove from server
        Storage::delete($path);

        if ($import) {
            //redirect            
            return redirect()->route('cash-transfers.index')->with('success', __('Data Berhasil Diimport!'));
        } else {
            //redirect
            return redirect()->route('cash-transfers.index')->with('error', __('Data gagal Diimport!'));
        }
    }

    public function downloadFileSetoranWajib(Request $request)
    {
        $myFile = storage_path("sample/setoran-simpanan-wajib.csv");

        return response()->download($myFile);
    }

    public function downloadFileSetoranSukarela(Request $request)
    {
        $myFile = storage_path("sample/setoran-simpanan-sukarela.csv");

        return response()->download($myFile);
    }

    public function downloadFilePemasukanKas(Request $request)
    {
        $myFile = storage_path("sample/pemasukan-kas.csv");

        return response()->download($myFile);
    }
    public function downloadFilePengeluaranKas(Request $request)
    {
        $myFile = storage_path("sample/pengeluaran-kas.csv");

        return response()->download($myFile);
    }
    public function downloadFileTransferKas(Request $request)
    {
        $myFile = storage_path("sample/transfer-kas.csv");

        return response()->download($myFile);
    }
}
