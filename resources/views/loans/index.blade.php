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
                <div class="card ">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA PINJAMAN ANGGOTA </h3>
                        @can('pinjaman create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('loans.create') }}" class="btn btn-primary sm-3">
                                <i class="fas fa-plus"></i>
                                {{ __('Tambah') }}
                            </a>
                        </div>
                        @endcan
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="divTable">
                            <div class="divTableRow">
                                <div class="divTableCellhd" align="center">{{ __('Kode') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Tanggal Pinjam') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Nama Anggota') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Hitungan') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Total Tagihan') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Lunas') }}</div>
                                <div class="divTableCellhd" align="center">{{ __('Action') }}</div>
                            </div>
                            @foreach ($dataPinjaman as $pinjaman)
                            @php
                            $pokokAngsuran = ceil($pinjaman->harga / $pinjaman->lama_angsuran);
                            $margin = $pinjaman->biaya_adm;
                            $totalAngsuran = $pokokAngsuran + $margin;
                            $totalTagihan = $totalAngsuran * $pinjaman->lama_angsuran;
                            $sisaAngsuran = $pinjaman->lama_angsuran - $pinjaman->sisa_angsuran;
                            $sisaTagihan = $totalTagihan - $pinjaman->sudah_bayar;
                            @endphp
                            <div class="divTableRow">
                                <div class="divTableCell" align="center">{{'PJ' . str_pad($pinjaman->id, 5, '0', STR_PAD_LEFT)}}</div>
                                <div class="divTableCell" align="center">{{date('j \\ F Y', strtotime($pinjaman->tgl_pinjam))}}</div>
                                <div class="divTableCell">{{$pinjaman->member_id}}<br>{{$pinjaman->first_name}}<br>{{$pinjaman->last_name}}</div>
                                <div class="divTableCell2">
                                    <table>
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td align="right">{{Str::limit($pinjaman->nm_barang, 12)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga Barang</td>
                                            <td align="right">Rp. {{number_format($pinjaman->harga)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Lama Angsuran</td>
                                            <td align="right">{{$pinjaman->lama_angsuran}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pokok Angsuran</td>
                                            <td align="right">Rp. {{number_format(ceil($pinjaman->harga / $pinjaman->lama_angsuran))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Bunga</td>
                                            <td align="right">{{number_format($pinjaman->bunga)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Margin</td>
                                            <td align="right">{{number_format($pinjaman->biaya_adm)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="divTableCell1">
                                    <table>
                                        <tr>
                                            <td>Jumlah Angsuran</td>
                                            <td align="right">Rp. {{number_format($totalAngsuran)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Tagihan</td>
                                            <td align="right">Rp. {{number_format($totalTagihan)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Sudah Di Bayar</td>
                                            <td align="right">Rp. {{number_format($pinjaman->sudah_bayar)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Sisa Angsuran</td>
                                            <td align="right">{{$sisaAngsuran}}</td>
                                        </tr>
                                        <tr>
                                            <td>Sisa Tagihan</td>
                                            <td align="right">Rp. {{number_format($sisaTagihan)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="divTableCell" align="center">{{$pinjaman->lunas}}</div>
                                <div class="divTableCell" align="center">Detail<br>MoU</div>
                            </div>
                            @endforeach
                        </div>
                        Halaman : {{ $dataPinjaman->currentPage() }} <br />
                        Jumlah Data : {{ $dataPinjaman->total() }} <br />
                        Data Per Halaman : {{ $dataPinjaman->perPage() }} <br />


                        {{ $dataPinjaman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<style>
    .divTable {
        width: 100%;
        display: table;
        -webkit-box-shadow: 1px 1px 1px 1px 1px 1px 1px #888888;
        box-shadow: 1px 1px 1px 1px 1px 1px 1px #888888;
    }

    .divTableRow {
        width: 100%;
        height: 100%;
        display: table-row;
    }

    .divTableCell {
        padding: 5px;
        width: 14%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTableCell1 {
        padding: 5px;
        width: 20%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTableCell2 {
        padding: 5px;
        width: 20%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTableCellhd {
        background-color: #4a6b82;
        color: #fff;
        padding: 5px;
        width: 14%;
        height: 100%;
        display: table-cell;
        border: 1px solid #808080;
    }

    .divTable .divTableRow:nth-child(odd) {
        background-color: #aad4ff;
    }

    .divTable .divTableRow:hover {
        background-color: #FBEDBB;
    }
</style>
@endsection