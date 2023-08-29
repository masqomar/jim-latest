@extends('layouts.user')

@section('title', trans('Detail Pembiayaan'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
        <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Detail Pembiayaan</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="section mt-1 mb-5">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th class="text-center">Tanggal Angsuran</th>
                        <th class="text-center">Angsuran Ke</th>
                        <th class="text-center">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjamanDetail as $angsuran)
                    <tr>
                        <td class="text-center">{{ $angsuran->tgl_bayar->format('d-m-Y') }}</td>
                        <td class="text-center">{{ $angsuran->angsuran_ke }}</td>
                        <td class="text-center">@rupiah ($angsuran->jumlah_bayar )</td>
                    </tr>
                    @endforeach                    
                    <tr>
                        <th class="text-center">Total Pembayaran Angsuran</th>
                        <td colspan="2" class="text-right"><strong>@rupiah ($totalAngsuran)</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endsection