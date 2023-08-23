<?php

namespace App\Imports;

use App\Models\CashType;
use App\Models\SavingTransaction;
use App\Models\SavingType;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenarikanSimpananImport implements ToModel, WithHeadingRow
{

    use Importable;

    protected $users;
    protected $savingTypes;
    protected $cashTypes;
    public function __construct()
    {
        //QUERY UNTUK MENGAMBIL SELURUH DATA USER
        $this->users = User::select('id', 'member_id')->get();
        $this->savingTypes = SavingType::select('id', 'jns_simpan')->get();
        $this->cashTypes = CashType::select('id', 'nama')->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = $this->users->where('member_id', $row['no_anggota'])->first();
        $simpanan = $this->savingTypes->where('jns_simpan', $row['jns_simpan'])->first();
        $bank = $this->cashTypes->where('nama', $row['ambil_dari_bank'])->first();
        return new SavingTransaction([
            'tgl_transaksi' => $row['tanggal'],
            'anggota_id' => $user->id ?? NULL,
            'jenis_id' => $simpanan->id ?? NULL,
            'jumlah' => $row['jumlah'],
            'keterangan' => $row['keterangan'],
            'akun' => 'Penarikan',
            'dk' => 'K',
            'kas_id' => $bank->id ?? NULL,
        ]);
    }
}
