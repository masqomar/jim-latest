@extends('layouts.user')

@section('title', trans('Detail Penarikan Simpanan Sukarela'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Detail Penarikan Simpanan Sukarela</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Bukti Pencairan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailPenarikanSukarela as $penarikanSukarela)
                        @if($anggotaID == Auth::user()->id)
                        <tr>
                            <td class="text-center">{{ $penarikanSukarela->tgl_transaksi->format('d-m-Y')}}</td>
                            <td class="text-center">@rupiah ($penarikanSukarela->jumlah)</td>
                            <td class="text-center">{{ $penarikanSukarela->keterangan}}</td>
                            <td class="text-center">
                                @if ($penarikanSukarela->saving_transaction_image == null)
                                <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" class="rounded" style="width: 50px">
                                @else
                                <img src="{{ asset('storage/uploads/saving-transaction-images/' . $penarikanSukarela->saving_transaction_image) }}" class="rounded" style="width: 50px">
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach

                        @if($anggotaID == Auth::user()->id)
                        <tr>
                            <th class="text-center">Total Penarikan Simpanan Sukarela</th>
                            <td colspan="2" class="text-center"><strong>@rupiah($totalPenarikanSukarela)</strong></td>
                        </tr>
                        @endif


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection