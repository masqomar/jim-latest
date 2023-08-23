@extends('layouts.user')

@section('title', trans('Simpanan Sukarela'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Simpanan Sukarela</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
@if($anggotaID == Auth::user()->id)

<h6 class="text-center"><strong>Total Simpanan @rupiah($setoranSimpananSukarela)</strong></h6>
<h6 class="text-center"><strong>Pengambilan Simpanan @rupiah($penarikanSimpananSukarela)</strong><a href="{{ route('user.sim-sukarela.show', $anggotaID) }}">Detail</a> </h6>
<h3 class="text-center"><strong>Saldo Simpanan Sukarela @rupiah($totalSimpananSukarela)</strong></h3>
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal Setor</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($simpananSukarela as $sukarela)
                        @if($anggotaID == Auth::user()->id)
                        <tr>
                            <td class="text-center">{{ $sukarela->tgl_transaksi->format('d-m-Y')}}</td>
                            <td class="text-center">{{ $sukarela->tgl_transaksi->format('m-Y')}}</td>
                            <td class="text-center">@rupiah ($sukarela->jumlah)</td>
                        </tr>
                        @endif
                        @endforeach


                    </tbody>
                </table>
               
                <br>
                Halaman : {{ $simpananSukarela->currentPage() }} <br />
                Jumlah Data : {{ $simpananSukarela->total() }} <br />
                Data Per Halaman : {{ $simpananSukarela->perPage() }} <br />


                {{ $simpananSukarela->links() }}
            </div>
        </div>
    </div>
</div>
@endsection