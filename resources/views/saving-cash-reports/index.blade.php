@extends('adminlte::page')
@section('title','Laporan Kas Simpanan')
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">L</b>APORAN KAS SIMPANAN </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="" method="get">
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
                            <table class="table table-bordered" width="100%">
                                <tr>
                                    <th style="width:5%; vertical-align: middle; text-align:center; background-color: grey"> No. </th>
                                    <th style="width:25%; vertical-align: middle; text-align:center; background-color: grey">Jenis Simpanan </th>
                                    <th style="width:20%; vertical-align: middle; text-align:center; background-color: grey"> Total Setoran </th>
                                    <th style="width:20%; vertical-align: middle; text-align:center; background-color: grey"> Total Penarikan </th>
                                    <th style="width:20%; vertical-align: middle; text-align:center; background-color: grey"> Saldo </th>
                                </tr>
                                <tr>
                                    <td class="text-center"> 1 </td>
                                    <td> Simpanan Pokok</td>
                                    <td style="text-align:right;"> @rupiah($totalSetoranSimPokok)</td>
                                    <td style="text-align:right;"> @rupiah($totalPenarikanSimPokok)</td>
                                    <td style="text-align:right;"> @rupiah($saldoSimPokok)</td>
                                </tr>
                                <tr>
                                    <td class="text-center"> 2 </td>
                                    <td> Simpanan Wajib</td>
                                    <td style="text-align:right;"> @rupiah($totalSetoranSimWajib)</td>
                                    <td style="text-align:right;"> @rupiah($totalPenarikanSimWajib)</td>
                                    <td style="text-align:right;"> @rupiah($saldoSimWajib)</td>
                                </tr>
                                <tr>
                                    <td class="text-center"> 3 </td>
                                    <td> Simpanan Sukarela</td>
                                    <td style="text-align:right;"> @rupiah($totalSetoranSimSukarela)</td>
                                    <td style="text-align:right;"> @rupiah($totalPenarikanSimSukarela)</td>
                                    <td style="text-align:right;"> @rupiah($saldoSimSukarela)</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center"><strong>Jumlah Total</strong></td>
                                    <td style="text-align:right;"><strong>@rupiah($totalSetoran)</strong></td>
                                    <td style="text-align:right;"><strong>@rupiah($totalPenarikan)</strong></td>
                                    <td style="text-align:right;"><strong>@rupiah($totalSaldo)</strong></td>
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