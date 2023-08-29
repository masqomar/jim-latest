@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.DateRangePicker', true)
@section('plugins.TempusDominusBs4', true)
@section('title', 'Rekapitulasi Transaksi Jimpay')
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">L</b>APORAN TRANSAKSI JIMPAY </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <form action="{{route('jimpay-transactions.index')}}" method="get">
                                @php
                                $configYear = ['format' => 'Y'];
                                @endphp
                                <x-adminlte-input-date name="tahun" :config="$configYear" placeholder="Pilih Tahun Buku...">
                                    <x-slot name="appendSlot">
                                        <div class="input-group-text bg-gradient-danger">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-date>
                                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-sm fa-save" />
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                        $heads = ['','Anggota','Jan','Peb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nop','Des'];
                        @endphp
                        <x-adminlte-datatable id="daterange_table" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered compressed with-buttons />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection