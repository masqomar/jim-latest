<?php

namespace App\Exports;

use App\Models\SavingTransaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SetoranSimpananExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return SavingTransaction::query()
            ->select('id', 'tgl_transaksi', 'anggota_id', 'jenis_id', 'jumlah', 'keterangan', 'kas_id')
            ->where('akun', 'Setoran')
            ->orderBy('anggota_id', 'ASC');
    }

    public function map($simpanan): array
    {
        return [
            $simpanan->id,
            $simpanan->tgl_transaksi,
            $simpanan->user->member_id,
            $simpanan->user->first_name,
            $simpanan->saving_type->jns_simpan,
            $simpanan->jumlah,
            $simpanan->keterangan,
            $simpanan->cash_type->nama,
        ];
    }

    public function headings(): array
    {
        return ["Id", "Tanggal Transaksi", "No Anggota", "Nama Anggota", "Jenis Simpanan", "Jumlah Penarikan", "Keterangan", "Simpan Di Bank"];
    }
}
