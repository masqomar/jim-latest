@extends('adminlte::page')
@section('title','Data Pinjaman Anggota')
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
                @if (session('success'))
                <x-adminlte-alert theme="success" title="Success">
                    {{session('success')}}
                </x-adminlte-alert>
                @endif
                <div class="card">
                    <div class="card-body">
                        @php
                        $heads = ['Kode','Tanggal Pinjam','Nama Anggota','Hitungan', 'Total Tagihan', 'Lunas'];
                        @endphp
                        <x-adminlte-datatable id="table4" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered with-buttons />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection