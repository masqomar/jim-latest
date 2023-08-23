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
                                            <td>{{ isset($savingTransaction->tgl_transaksi) ? $savingTransaction->tgl_transaksi->format('d/m/Y H:i') : ''  }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $savingTransaction->user ? $savingTransaction->user->first_name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Saving Type') }}</td>
                                        <td>{{ $savingTransaction->saving_type ? $savingTransaction->saving_type->jns_simpan : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Jumlah') }}</td>
                                            <td>{{ $savingTransaction->jumlah }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Akun') }}</td>
                                            <td>{{ $savingTransaction->akun }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Dk') }}</td>
                                            <td>{{ $savingTransaction->dk }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Cash Type') }}</td>
                                        <td>{{ $savingTransaction->cash_type ? $savingTransaction->cash_type->nama : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $savingTransaction->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $savingTransaction->updated_at->format('d/m/Y H:i') }}</td>
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