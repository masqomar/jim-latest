<?php

namespace App\Imports;

use App\Models\AccountType;
use App\Models\CashTransaction;
use App\Models\CashType;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KasKeluarImport implements ToModel, WithHeadingRow
{
    use Importable;

    protected $accounTypes;
    protected $cashTypes;
    public function __construct()
    {
        
        $this->accounTypes = AccountType::select('id', 'jns_trans')->get();
        $this->cashTypes = CashType::select('id', 'nama')->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         $jenisAkun = $this->accounTypes->where('jns_trans', $row['nama_akun'])->first();
        $bank = $this->cashTypes->where('nama', $row['ambil_dari_bank'])->first();
       
        return new CashTransaction([
            'tgl_catat' => $row['tanggal'],
            'jumlah' => $row['jumlah'],
            'keterangan' => $row['keterangan'],
            'akun' => 'Pengeluaran',
            'jns_trans' => $jenisAkun->id ?? NULL,
            'dk' => 'K',
            'dari_kas_id' => $bank->id ?? NULL,
        ]);
    }
}
