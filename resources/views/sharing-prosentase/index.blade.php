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
                        <div class="col-md-12">
                            <form action="{{route('sharing-prosentase.filter')}}" method="get">
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
                        @php
                        $heads = ['ID','Name','Simpanan/SHU','Pembiayaan/SHU','Jimmart/SHU','SHU Diterimakan'];
                        @endphp
                        <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" striped hoverable with-buttons />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection