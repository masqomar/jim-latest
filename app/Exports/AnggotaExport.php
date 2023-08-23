<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class AnggotaExport implements FromQuery
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return User::select('member_id', 'first_name', 'last_name', 'status')
        ->where('type', 'user')
        ->orderBy('member_id', 'ASC');
    }
}
