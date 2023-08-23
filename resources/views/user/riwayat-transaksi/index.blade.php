@extends('layouts.user')

@section('title', trans('Riwayat Transaksi'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
           <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Riwayat Transaksi</div>
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
                            <th class="text-center" width=30%>Tanggal</th>
                            <th class="text-center" width=30%>Nominal</th>
                            <th class="text-center" width=40%>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatTransaksiAll as $riwayatTransaksi)
                        <tr>
                            <td class="text-center">{{ $riwayatTransaksi->created_at->format('d-m-Y')}}</td>
                            <td class="text-center">@rupiah ($riwayatTransaksi->amount)</td>
                            @php
                            $meta = json_decode($riwayatTransaksi['meta'], true);
                            @endphp
                            @if ($meta)
                            <td class="text-center">{{ $meta['description'] ?? 'Tidak Ada Keterangan'}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
                Halaman : {{ $riwayatTransaksiAll->currentPage() }} <br />
                Jumlah Data : {{ $riwayatTransaksiAll->total() }} <br />
                Data Per Halaman : {{ $riwayatTransaksiAll->perPage() }} <br />


                {{ $riwayatTransaksiAll->links() }}
            </div>
        </div>
    </div>
</div>
@endsection