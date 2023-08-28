@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.DateRangePicker', true)
@section('title', 'Neraca Saldo')
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">L</b>APORAN NERACA SALDO </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{route('balance-sheet-reports.filter')}}" method="get">
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label>Date From</label>
                                        <input type="date" name="dari_tanggal" class="form-control">
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label>Date From</label>
                                        <input type="date" name="sampai_tanggal" class="form-control">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:25px;">
                                        <input type="submit" class="btn btn-primary" value="Search">
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('balance-sheet-reports.cetak_pdf')}}" method="get" target="_blank">
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label>Date From</label>
                                        <input type="date" name="dari_tanggal" class="form-control">
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label>Date From</label>
                                        <input type="date" name="sampai_tanggal" class="form-control">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:25px;">
                                        <input type="submit" class="btn btn-primary" value="Cetak">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="myTable" width="100%">
                                <tr>
                                    <th style="text-align:center; width:5%"> </th>
                                    <th style="text-align:center; width:55%"> Nama Akun</th>
                                    <th style="text-align:center; width:20%"> Debet </th>
                                    <th style="text-align:center; width:20%"> Kredit </th>
                                </tr>
                                <tr>
                                    <td> &nbsp; <i class="nav-icon fas fa-folder-open"></i> </td>
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
                                    <td class="text-center"> &nbsp; <i class="nav-icon fas fa-folder-open"></i> </td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection