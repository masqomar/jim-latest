<?php

namespace App\Exports;

use App\Models\CashTransaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KasMasukExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return CashTransaction::query()->select('id', 'tgl_catat', 'jumlah', 'keterangan', 'untuk_kas_id')->where('akun', 'Pemasukan')->orderBy('tgl_catat', 'ASC');
    }

    public function map($kasMasuk): array
    {
        return [
            $kasMasuk->id,
            $kasMasuk->tgl_catat,
            $kasMasuk->jumlah,
            $kasMasuk->keterangan,
            $kasMasuk->to_cash_type->nama,
        ];
    }

    public function headings(): array
    {
        return ["Id", "Tanggal Transaksi", "Jumlah Pemasukan", "Keterangan", "Jenis Kas"];
    }
}
