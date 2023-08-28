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
        .page_break { page-break-before: always; }
    </style>
<body>

    <table class='table table-bordered'>
        <center>
            <h5>Laporan Neraca Periode {{date('j F Y', strtotime(request()->get('dari_tanggal')))}} - {{date('j F Y', strtotime(request()->get('sampai_tanggal')))}}</h5>
        </center>
        <table class="table table-striped" id="myTable" width="100%">
            <tr>
                <th style="text-align:center; width:5%"> </th>
                <th style="text-align:center; width:55%"> Nama Akun</th>
                <th style="text-align:center; width:20%"> Debet </th>
                <th style="text-align:center; width:20%"> Kredit </th>
            </tr>
            <tr>
                <td> </td>
                <td><strong> A. Aktiva Lancar </strong></td>
            </tr>
            @php
            $total = 0;
            $total_kas_semua = 0;
            @endphp
            @foreach ($saldo as $data)
            <tr>
                <td></td>
                <td>A{{ $data['kas_id'] }}. {{ $data['kas_nama'] }}</td>
                <td style="text-align: right;">{{ number_format($data['sisaSaldo']) }}</td>
                <td style="text-align: right;"> 0 </td>
            </tr>
            @php
            $total_kas_semua = $total += $data['sisaSaldo'];
            @endphp
            @endforeach

            @php
            $total_aktifa = 0;
            $total_pasiva = 0;
            $total_aktifa_akun = 0;
            $total_pasiva_akun = 0;
            @endphp

            @foreach($jenisAkun as $akun)
            @php
            $transaksiDebet = DB::table('v_transaksi')->where('transaksi', $akun->id)->whereBetween('tgl', [request()->get('dari_tanggal'), request()->get('sampai_tanggal')])->sum('debet');
            $transaksiKredit = DB::table('v_transaksi')->where('transaksi', $akun->id)->whereBetween('tgl', [request()->get('dari_tanggal'), request()->get('sampai_tanggal')])->sum('kredit');
            @endphp
            <tr>
                @if (strlen($akun->kd_aktiva) != 1)
                <td> &nbsp; </td>
                <td>{{$akun->kd_aktiva}}. {{$akun->jns_trans}}</td>
                @else
                <td class="text-center"> </td>
                <td> <strong>{{$akun->kd_aktiva}}. {{$akun->jns_trans}}</strong></td>
                @endif

                @if ($akun->akun == 'Aktiva')
                <td style="text-align: right;">{{number_format ($transaksiKredit - $transaksiDebet)}}</td>
                <td style="text-align: right;">0</td>
                @php
                $saldoAktifa = $transaksiKredit - $transaksiDebet;
                $total_aktifa_akun = $total_aktifa += $saldoAktifa;
                @endphp
                @endif

                @if ($akun->akun == 'Pasiva')
                <td style="text-align: right;">0</td>
                <td style="text-align: right;">{{number_format ($transaksiDebet - $transaksiKredit)}}</td>
                @php
                $saldoPasiva = $transaksiDebet - $transaksiKredit;
                $total_pasiva_akun = $total_pasiva += $saldoPasiva;
                @endphp
                @endif
            </tr>
            @endforeach

            <tr>
                <td colspan="2" style="text-align: center;"><strong> JUMLAH KUABEH</td>
                <td style="text-align: right;"><strong>{{number_format($total_kas_semua + $total_aktifa_akun)}}</strong></td>
                <td style="text-align: right;"><strong>{{number_format($total_pasiva_akun)}}</strong></td>
            </tr>
        </table>

</body>

</html>