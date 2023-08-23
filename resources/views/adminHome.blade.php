@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <x-adminlte-small-box title="{{$totalUser}}" text="Anggota" icon="fas fa-user" theme="primary" url="users" url-text="Lihat Detail" id="sbUpdatable" />
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <x-adminlte-small-box title="{{number_format($totalPenarikan)}}" text="Penarikan Simpanan" icon="fas fa-store" theme="success" url="merchants" url-text="Lihat Detail" id="sbUpdatable" />
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <x-adminlte-small-box title="{{number_format($totalSimpanan)}}" text="Setoran Simpanan" icon="fas fa-wallet" theme="info" url="#" url-text="Lihat Detail" id="sbUpdatable" />
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <x-adminlte-small-box title="{{number_format($totalPembiayaan)}}" text="Pembiayaan" icon="fas fa-medal" theme="danger" url="#" url-text="Lihat Detail" id="sbUpdatable" />
                </div>
            </div>
        </div>
    </div>
</div>
@stop