<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogActivityController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $activities = ActivityLog::with('user')->orderBy('id', 'DESC');

            return DataTables::of($activities)
                ->addColumn('user', function ($row) {
                    return $row->user->first_name;
                })
                ->addColumn('waktu', function ($row) {
                    return Carbon::parse($row->created_at)->diffForHumans();
                })
                ->setRowAttr([
                    'properties' => function ($row) {
                        return $row->properties;
                    },
                ])
                ->toJson();
        }
        
        return view('log-acivity.index');
    }
}
