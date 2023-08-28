@extends('adminlte::page')
@section('title','Laporan Kas Anggota')
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">L</b>APORAN KAS ANGGOTA </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="col-md-12">
                            <form action="{{route('user-saving-reports.cetak_pdf')}}" method="get" target="_blank">
                                <div class="row">
                                    
                                    <div class="col-md-2 form-group" style="margin-top:25px;">
                                        <input type="submit" class="btn btn-primary" value="Cetak">
                                    </div>
                                </div>
                            </form>
                        </div>
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
                        </div>
                        Halaman : {{ $dataAnggota->currentPage() }} <br />
                        Jumlah Data : {{ $dataAnggota->total() }} <br />
                        Data Per Halaman : {{ $dataAnggota->perPage() }} <br />


                        {{ $dataAnggota->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('css')
<style>
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
</style>
@endsection