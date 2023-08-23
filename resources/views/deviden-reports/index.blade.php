@extends('adminlte::page')
@section('title','Laporan Pembagian SHU')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-0">
            <div class="col-sm-6">
                <!-- <h4> Daftar Pengguna  </h4> -->
            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">L</b>APORAN PEMBAGIAN SHU </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="divTable">
                            <div class="divTableRow">
                                <div class="divTableCellhd" align="center">{{ __('Nama Anggota') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('SHU Simpanan') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Usaha Anggota') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('SHU JIMMART') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('SHU Diterimakan') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Action') }}</div>
                            </div>
                            @foreach ($pembagianShu as $pembagian)
                            <div class="divTableRow">
                                <div class="divTableCell">
                                    No Anggota : {{$pembagian->member_id}}<br>
                                    Nama Anggota : {{$pembagian->first_name}}
                                </div>

                                <div class="divTableCell1">
                                    @php
                                    $setoranPokok = DB::table('saving_transactions')->where('anggota_id', $pembagian->id)->where('jenis_id', 40)->where('akun', 'setoran')->sum('jumlah');
                                    $penarikanPokok = DB::table('saving_transactions')->where('anggota_id', $pembagian->id)->where('jenis_id', 40)->where('akun', 'Penarikan')->sum('jumlah');
                                    $saldoPokok = $setoranPokok - $penarikanPokok;

                                    $setoranWajib = DB::table('saving_transactions')->where('anggota_id', $pembagian->id)->where('jenis_id', 41)->where('akun', 'setoran')->sum('jumlah');
                                    $penarikanWajib = DB::table('saving_transactions')->where('anggota_id', $pembagian->id)->where('jenis_id', 41)->where('akun', 'Penarikan')->sum('jumlah');
                                    $saldoWajib = $setoranWajib - $penarikanWajib;

                                    $setoranSuka = DB::table('saving_transactions')->where('anggota_id', $pembagian->id)->where('jenis_id', 32)->where('akun', 'setoran')->sum('jumlah');
                                    $penarikanSuka = DB::table('saving_transactions')->where('anggota_id', $pembagian->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->sum('jumlah');
                                    $saldoSuka = $setoranSuka - $penarikanSuka;

                                    $totalSaldoSimpanan = $saldoPokok + $saldoWajib + $saldoSuka;

                                    $pembiayaan = DB::table('loans')->where('anggota_id', $pembagian->id)->sum('jumlah');
                                    $pembiayaanMargin = DB::table('loans')->where('anggota_id', $pembagian->id)->sum('biaya_adm') * 6;
                                    $totalPembiayaan = $pembiayaan + $pembiayaanMargin;

                                    $transaksiJimpay = DB::table('transactions')->where('payable_id', $pembagian->id)->where('type', 'withdraw')->sum('amount');
                                    $transaksiTransfer = DB::table('transactions')->leftJoin('transfers', 'transfers.from_id', 'transactions.payable_id')->where('payable_id', $pembagian->id)->where('type', 'withdraw')->sum('amount');
                                    $totalTransaksi = $transaksiJimpay + ($transaksiTransfer);
                                    @endphp
                                    <table>
                                        <tr>
                                            <td>Simpanan Pokok</td>
                                            <td align="right">&emsp;{{number_format($saldoPokok)}}</td>
                                            <td align="right">&emsp;&emsp;shu</td>
                                        </tr>
                                        <tr>
                                            <td>Simpanan Wajib</td>
                                            <td align="right">&emsp;{{number_format($saldoWajib)}}</td>
                                            <td align="right">&emsp;&emsp;shu</td>
                                        </tr>
                                        <tr>
                                            <td>Simpanan Sukarela</td>
                                            <td align="right">&emsp;{{number_format($saldoSuka)}}</td>
                                            <td align="right">&emsp;&emsp;shu</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="divTableCell2" align="center">
                                    <table>
                                        <tr>
                                            <td>Pembiayaan</td>
                                            <td align="right">&emsp;{{number_format($totalPembiayaan)}}</td>
                                            <td align="right">&emsp;&emsp;shu</td>
                                        </tr>
                                        <tr>
                                            <td>JIMPay</td>
                                            <td align="right">&emsp;{{number_format(abs($transaksiJimpay))}}</td>
                                            <td align="right">&emsp;&emsp;shu</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="divTableCell" align="center">aa</div>
                                <div class="divTableCell" align="center">aa</div>
                                <div class="divTableCell" align="center">aa</div>
                            </div>
                            @endforeach
                        </div>
                        Halaman : {{ $pembagianShu->currentPage() }} <br />
                        Jumlah Data : {{ $pembagianShu->total() }} <br />
                        Data Per Halaman : {{ $pembagianShu->perPage() }} <br />


                        {{ $pembagianShu->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('js')
<style>
    .divTable {
        width: 100%;
        display: table;
        -webkit-box-shadow: 1px 1px 1px 1px 1px 1px #888888;
        box-shadow: 1px 1px 1px 1px 1px 1px #888888;
    }

    .divTableRow {
        width: 100%;
        height: 100%;
        display: table-row;
    }

    .divTableCell {
        padding: 5px;
        width: 10%;
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
        width: 30%;
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
</style>
@endsection