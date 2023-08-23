@extends('adminlte::page')
@section('title', __('Cash Transactions'))
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-0">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <td class="fw-bold">{{ __('Tgl Transaksi') }}</td>
                                    <td>{{ isset($withdrawal->tgl_transaksi) ? $withdrawal->tgl_transaksi->format('d-m-Y') : ''  }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Anggota') }}</td>
                                    <td>{{ $withdrawal->user ? $withdrawal->user->first_name : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Jenis Simpanan') }}</td>
                                    <td>{{ $withdrawal->saving_type ? $withdrawal->saving_type->jns_simpan : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Jumlah') }}</td>
                                    <td>{{ $withdrawal->jumlah }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Keterangan') }}</td>
                                    <td>{{ $withdrawal->keterangan ? $withdrawal->keterangan : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Ambil Dari Kas') }}</td>
                                    <td>{{ $withdrawal->cash_type ? $withdrawal->cash_type->nama : '' }}</td>
                                </tr>
                            </table>
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection