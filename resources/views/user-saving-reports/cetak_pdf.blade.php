<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Neraca Periode {{request()->get('dari_tanggal')}} - {{request()->get('sampai_tanggal')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
    }

   .divTable {
        width: 100%;
        display: table;
        -webkit-box-shadow: 1px 1px 1px 1px 1px#888888;
        box-shadow: 1px 1px 1px 1px 1px#888888;
    }

    .divTableRow {
        width: 100%;
        height: 100%;
        display: table-row;
    }

    .divTableCell {
        padding: 5px;
        width: 25%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTableCell1 {
        padding: 5px;
        width: 33%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTableCell2 {
        padding: 5px;
        width: 10%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTableCellhd {
        background-color: #4a6b82;
        color: #fff;
        padding: 5px;
        width: 14%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTable .divTableRow:nth-child(odd) {
        background-color: #aad4ff;
    }

    .divTable .divTableRow:hover {
        background-color: #FBEDBB;
    }

    .page_break {
        page-break-before: always;
    }
</style>

<body>
    <div class="table-responsive p-1">
        <table class="table" width="100%">
            <tr>
                <th>{{ __('Anggota') }}</th>
                <th>{{ __('Saldo Simpanan') }}</th>
                <th>{{ __('Tagihan Kredit') }}</th>
                <th>{{ __('Keterangan') }}</th>
            </tr>
            @foreach($dataAnggota as $anggota)
            <tr>
                <td>
                    <table>
                        <tr>
                            <td> ID Anggota : {{$anggota->member_id}}</td>
                        </tr>
                        <tr>
                            <td> Nama Anggota : {{$anggota->first_name}}</td>
                        </tr>
                        <tr>
                            <td> Email : {{$anggota->email}}</td>
                        </tr>
                        <tr>
                            <td> Telepon : {{$anggota->country_code}}{{$anggota->mobile}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        @php
                        $setoran_sim_pokok = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 40)->where('akun', 'setoran')->sum('jumlah');
                        $penarikan_sim_pokok = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 40)->where('akun', 'Penarikan')->sum('jumlah');
                        $saldoSimPokok = $setoran_sim_pokok - $penarikan_sim_pokok;

                        $setoran_sim_wajib = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 41)->where('akun', 'setoran')->sum('jumlah');
                        $penarikan_sim_wajib = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 41)->where('akun', 'Penarikan')->sum('jumlah');
                        $saldoSimWajib = $setoran_sim_wajib - $penarikan_sim_wajib;

                        $setoran_sim_sukarela = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'setoran')->sum('jumlah');
                        $penarikan_sim_sukarela = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->sum('jumlah');
                        $saldoSimSukarela = $setoran_sim_sukarela - $penarikan_sim_sukarela;

                        $totalSaldoSimpanan = $saldoSimPokok + $saldoSimWajib + $saldoSimSukarela;
                        @endphp
                        <tr>
                            <td> Simpanan Pokok : {{$saldoSimPokok}}</td>
                        </tr>
                        <tr>
                            <td> Simpanan Wajib : {{$saldoSimWajib}}</td>
                        </tr>
                        <tr>
                            <td> Simpanan Sukarela : {{$saldoSimSukarela}}</td>
                        </tr>
                        <tr>
                            <td> Jumlah Simpanan : {{$totalSaldoSimpanan}}</td>
                        </tr>
                    </table>
                </td>
                @php
                $pokokPinjaman = DB::table('loans')->where('anggota_id', $anggota->id)->sum('jumlah');
                $margin = DB::table('loans')->where('anggota_id', $anggota->id)->sum('biaya_adm');
                $keuntungan = $margin * 6;
                $totalTagihan = $pokokPinjaman + $keuntungan;
                $jumlahPinjaman = DB::table('loans')->where('anggota_id', $anggota->id)->count();
                $jumlahPinjamanLunas = DB::table('loans')->where('anggota_id', $anggota->id)->where('lunas', 'Lunas')->count();
                @endphp
                <td>
                    <table>
                        @foreach ($angsuran as $angsur)
                        @if ($angsur->anggota_id == $anggota->id)
                        <tr>
                            <td> Pokok Pinjaman : {{$pokokPinjaman}}</td>
                        </tr>
                        <tr>
                            <td> Total Tagihan : {{$totalTagihan}}</td>
                        </tr>

                        <tr>
                            <td> Dibayar : {{$angsur->dibayar}}</td>
                        </tr>
                        <tr>
                            <td> Sisa Angsuran : {{$totalTagihan - $angsur->dibayar}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td> Jumlah Pinjaman : {{$jumlahPinjaman}}</td>
                        </tr>
                        <tr>
                            <td> Pinjaman Lunas : {{$jumlahPinjamanLunas}}</td>
                        </tr>
                        <tr>
                            <td> Pembayaran : - </td>
                        </tr>
                        <tr>
                            <td> Tanggal Tempo : -</td>
                        </tr>
                    </table>
                </td>
            </tr>
            @endforeach
        </table>

</body>

</html>