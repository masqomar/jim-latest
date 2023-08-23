<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingTransaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevidenController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('type', 'user')->paginate(50);
        if($request->has('download'))
        {
            $pdf = PDF::loadView('devidens.print',compact('users'));
            return $pdf->download('pdfview.pdf');
        }

        return view('devidens.index', compact('users'));
    }

    public function filter(Request $request)
    {
        $users = User::where('type', 'user')->paginate(50);

        return view('devidens.index', compact('users'));
    }
}