@extends('layouts.user')

@section('title', trans('Simpanan Wajib'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
           <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Simpanan Wajib</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
@if($anggotaID == Auth::user()->id)

<h3 class="text-center"><strong>Total Simpanan Wajib @rupiah($totalSimpananWajib)</strong></h3>
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
                        @foreach ($simpananWajib as $wajib)
                        @if($anggotaID == Auth::user()->id)
                        <tr>
                            <td class="text-center">{{ $wajib->tgl_transaksi->format('d-m-Y')}}</td>
                            <td class="text-center">{{ $wajib->tgl_transaksi->format('m-Y')}}</td>
                            <td class="text-center">@rupiah ($wajib->jumlah)</td>
                        </tr>
                        @endif
                        @endforeach


                    </tbody>
                </table>

                <br>
                Halaman : {{ $simpananWajib->currentPage() }} <br />
                Jumlah Data : {{ $simpananWajib->total() }} <br />
                Data Per Halaman : {{ $simpananWajib->perPage() }} <br />


                {{ $simpananWajib->links() }}
            </div>
        </div>
    </div>
</div>
@endsection