<?php

namespace App\Exports;

use App\Models\CashTransaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KasTransferExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return CashTransaction::query()->select('id', 'tgl_catat', 'jumlah', 'keterangan', 'dari_kas_id', 'untuk_kas_id')->where('akun', 'Transfer')->orderBy('tgl_catat', 'ASC');
    }

    public function map($kasTransfer): array
    {
        return [
            $kasTransfer->id,
            $kasTransfer->tgl_catat,
            $kasTransfer->jumlah,
            $kasTransfer->keterangan,
            $kasTransfer->from_cash_type->nama,
            $kasTransfer->to_cash_type->nama,
        ];
    }

    public function headings(): array
    {
        return ["Id", "Tanggal Transaksi", "Jumlah Transfer", "Keterangan", "Dari Kas", "Kas Tujuan"];
    }
}
