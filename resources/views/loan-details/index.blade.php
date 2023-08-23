@extends('adminlte::page')
@section('title','Data Angsuran Pinjaman Anggota')
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
                <div class="card ">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA ANGSURAN PINJAMAN ANGGOTA </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Kode') }}</th>
                                        <th>{{ __('Tanggal Pinjam') }}</th>
                                        <th>{{ __('Nama Anggota') }}</th>
                                        <th>{{ __('Total Tagihan') }}</th>
                                        <th>{{ __('Jumlah Angsuran') }}</th>
                                        <th>{{ __('Sisa Tagihan') }}</th>
                                        <th>{{ __('Angsuran Ke') }}</th>
                                        <th>{{ __('Sisa Angsuran') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataAngsuran as $angsuran)
                                    @php
                                    $pokokAngsuran = ceil($angsuran->jumlah / $angsuran->lama_angsuran);
                                    $margin = $angsuran->biaya_adm;
                                    $totalAngsuran = $pokokAngsuran + $margin;
                                    $totalTagihan = $totalAngsuran * $angsuran->lama_angsuran;
                                    $sisaTagihan = $totalTagihan - $angsuran->sudah_bayar;
                                    $sisaAngsuran = $angsuran->lama_angsuran - $angsuran->sisa_angsuran;
                                    @endphp
                                    <tr>
                                        <td align="center">{{$loop->iteration}}</td>
                                        <td align="center">{{'PJ' . str_pad($angsuran->id, 5, '0', STR_PAD_LEFT)}}</td>
                                        <td align="center">{{date('j \\ F Y', strtotime($angsuran->tgl_pinjam))}}</td>
                                        <td>{{$angsuran->member_id}}<br>{{$angsuran->first_name}}</td>
                                        <td align="center">Rp. {{number_format($totalTagihan)}}</td>
                                        <td align="center">Rp. {{number_format($totalAngsuran)}}</td>
                                        <td align="center">Rp. {{number_format($sisaTagihan)}}</td>
                                        <td align="center">{{$angsuran->sisa_angsuran}} / {{$angsuran->lama_angsuran}}</td>
                                        <td align="center">{{$sisaAngsuran}} - bulan</td>
                                        <td>detail</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        Halaman : {{ $dataAngsuran->currentPage() }} <br />
                        Jumlah Data : {{ $dataAngsuran->total() }} <br />
                        Data Per Halaman : {{ $dataAngsuran->perPage() }} <br />


                        {{ $dataAngsuran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
