<?php

namespace App\Exports;

use App\Models\CashTransaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KasKeluarExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return CashTransaction::query()->select('id', 'tgl_catat', 'jumlah', 'keterangan', 'dari_kas_id')->where('akun', 'Pengeluaran')->orderBy('tgl_catat', 'ASC');
    }

    public function map($kasKeluar): array
    {
        return [
            $kasKeluar->id,
            $kasKeluar->tgl_catat,
            $kasKeluar->jumlah,
            $kasKeluar->keterangan,
            $kasKeluar->from_cash_type->nama,
        ];
    }

    public function headings(): array
    {
        return ["Id", "Tanggal Transaksi", "Jumlah Pengeluaran", "Keterangan", "Jenis Kas"];
    }
}
