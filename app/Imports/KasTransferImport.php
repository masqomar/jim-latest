<?php

namespace App\Imports;

use App\Models\CashTransaction;
use App\Models\CashType;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KasTransferImport implements ToModel, WithHeadingRow
{
    use Importable;

    protected $cashTypes;
    public function __construct()
    {
        $this->cashTypes = CashType::select('id', 'nama')->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $bankAsal = $this->cashTypes->where('nama', $row['transfer_dari_bank'])->first();
        $bankTujuan = $this->cashTypes->where('nama', $row['transfer_ke_bank'])->first();
       
        return new CashTransaction([
            'tgl_catat' => $row['tanggal'],
            'jumlah' => $row['jumlah'],
            'keterangan' => $row['keterangan'],
            'akun' => 'Transfer',
            'jns_trans' => 110,
            'dari_kas_id' => $bankAsal->id ?? NULL,
            'untuk_kas_id' => $bankTujuan->id ?? NULL,
        ]);
    }
}
