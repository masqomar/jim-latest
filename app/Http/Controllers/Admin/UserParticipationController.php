<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserParticipationController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'user')->paginate(50);

        return view('participations.index', compact('users'));
    }

    public function filter(Request $request)
    {
        $users = User::where('type', 'user')->paginate(50);

        return view('participations.index', compact('users'));
    }
}
