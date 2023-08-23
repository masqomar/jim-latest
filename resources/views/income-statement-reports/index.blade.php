@extends('adminlte::page')
@section('title','Laporan Neraca Saldo')
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">L</b>APORAN LABA RUGI </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{route('income-statement-reports.filter')}}" method="get">
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label for="">Date From</label>
                                        <input type="date" name="dari_tanggal" class="form-control">
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="">Date From</label>
                                        <input type="date" name="sampai_tanggal" class="form-control">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:25px;">
                                        <input type="submit" class="btn btn-primary" value="Search">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive p-1">
                            <h3> Estimasi Data Pinjaman </h3>
                            <table class="table table-bordered" width="100%">
                                <tr>
                                    <th style="width:5%; vertical-align: middle; text-align:center; background-color: grey"> No. </th>
                                    <th style="width:75%; vertical-align: middle; text-align:center; background-color: grey">Keterangan </th>
                                    <th style="width:20%; vertical-align: middle; text-align:center; background-color: grey"> Jumlah </th>
                                </tr>
                                <tr>
                                    <td class="text-center"> 1 </td>
                                    <td> Jumlah Pinjaman</td>
                                    <td style="text-align:right;"> @rupiah ($totalPinjaman)</td>
                                </tr>
                                <tr>
                                    <td class="text-center"> 2 </td>
                                    <td> Keuntungan</td>
                                    <td style="text-align:right;"> @rupiah ($keuntungan)</td>
                                </tr>
                                <tr>
                                    <td class="text-center"> 3 </td>
                                    <td> Pendapatan Biaya Bunga</td>
                                    <td style="text-align:right;"> @rupiah ($kembang)</td>
                                </tr>

                                <tr>
                                    <td class="text-center"> 4 </td>
                                    <td> Pendapatan Biaya Pembulatan</td>
                                    <td style="text-align:right;"> @rupiah ($pembulatan)</td>
                                </tr>
                                <tr style="text-align:right;">
                                    <td colspan="2"> <strong>Jumlah Tagihan</td>
                                    <td>@rupiah ($tagihan)</td>
                                </tr>
                                <tr style="text-align:right;">
                                    <td colspan="2"> <strong>Estimasi Pendapatan Pinjaman</strong></td>
                                    <td> @rupiah ($estimasiPendapatan)</td>
                                </tr>
                            </table>

                            <h3> Pendapatan </h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:5%; vertical-align: middle; text-align:center; background-color: grey"> No. </th>
                                    <th style="width:75%; vertical-align: middle; text-align:center; background-color: grey">Keterangan </th>
                                    <th style="width:20%; vertical-align: middle; text-align:center; background-color: grey"> Jumlah </th>
                                </tr>
                                <tr>
                                    <td class="text-center"> 1 </td>
                                    <td> Pendapatan Pinjaman</td>
                                    <td style="text-align:right;"> @rupiah ($pendapatanPinjaman)</td>
                                </tr>
                                @php
                                $total_jumlah_pendapatan = 0;
                                @endphp
                                @foreach ($akunPendapatan as $row)
                                @php
                                $jumlah_pendapatan = $row->total_akun_debet + $row->total_akun_kredit;
                                $total_jumlah_pendapatan = $pendapatanPinjaman + $jumlah_pendapatan;
                                @endphp
                                <tr>
                                    <td class="text-center"> {{$loop->iteration + 1}} </td>
                                    <td>{{$row->jns_trans}}</td>
                                    <td style="text-align:right;">@rupiah ($jumlah_pendapatan)</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" style="text-align:right;"> <strong>Jumlah Pendapatan</strong></td>
                                    <td style="text-align:right;">@rupiah ($total_jumlah_pendapatan)</td>
                                </tr>
                            </table>
                            <h3> Biaya-biaya </h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:5%; vertical-align: middle; text-align:center; background-color: grey"> No. </th>
                                    <th style="width:75%; vertical-align: middle; text-align:center; background-color: grey">Keterangan </th>
                                    <th style="width:20%; vertical-align: middle; text-align:center; background-color: grey"> Jumlah </th>
                                </tr>
                                @php
                                $sum_total_biaya = 0;
                                @endphp
                                @foreach ($akunBiaya as $biaya)
                                @php
                                $jumlah = $biaya->total_biaya_debet + $biaya->total_biaya_kredit
                                @endphp
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$biaya->jns_trans}}</td>
                                    <td style="text-align:right;">@rupiah ($jumlah)</td>
                                </tr>
                                @php
                                $sum_total_biaya += $jumlah;
                                @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2" style="text-align:right;"><strong> Jumlah Biaya</strong></td>
                                    <td style="text-align:right;">@rupiah ($sum_total_biaya)</td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr style="background-color: #98FB98;">
                                    <td colspan="2" style="text-align:right;"> <strong>Laba Rugi </strong></td>
                                    <td style="text-align:right;"><strong>@rupiah ($total_jumlah_pendapatan - $sum_total_biaya)</strong></td>
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