@extends('layouts.user')

@section('title', trans('Pembiayaan'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
        <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Pembiayaan</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<div class="card-body">
<div class="col-md-12">
       
        <br>
        <br>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <h4 class="text-center">Data Pembiayaan</h4>
    <div class="card">
        <div class="card-body">
          
            <div style="overflow-x:auto;">
                @forelse ($pembiayaanAll as $paylater)
                @if($anggotaID == Auth::user()->id)
                <table class="table table-striped">
                <tr>
                    <th class="text-left">Tanggal Pembiayaan</th>
                    <td class="text-right">{{ $paylater->tgl_pinjam->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <th class="text-left">Tenor</th>
                    <td class="text-right">{{ $paylater->lama_angsuran}}</td>
                </tr>
                <tr>
                    <th class="text-left">Jumlah</th>
                    @php
                    $angsuran = $paylater->jumlah / 6;
                    $keuntungan = $paylater->biaya_adm;
                    $total_angsuran = $angsuran + $keuntungan;
                    $total_tagihan = $total_angsuran * 6;
                    @endphp
                    <td class="text-right">@rupiah (ceil($total_tagihan))</td>
                </tr>
                <tr>
                    <th class="text-left">Angsuran /bln</th>
                    <td class="text-right">@rupiah (ceil($total_angsuran))</td>
                </tr>
                <tr>
                    <th class="text-left">Lunas</th>
                    @if ($paylater->lunas == 'Lunas')
                    <td class="text-center" style="background-color: aqua;">Lunas</td>
                    @else
                    <td class="text-center" style="background-color: red;">Belum Lunas</td>
                    @endif
                </tr>
                <tr>
                    <th class="text-left">Keterangan</th>
                    <td class="text-right">{{ $paylater->keterangan}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <a class="btn btn-sm btn-info" href="{{route('user.pembiayaan.show', $paylater->id)}}" role="button">Detail</a>
                    </td>
                </tr>
                <hr>
                @endif
                @empty
                <tr><th><td colspan="2" class="text-center">Belum ada data pembiayaan</td></th></tr>                
                @endforelse
        </table>
    </div>
    @endsection