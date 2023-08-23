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
                                            <td class="fw-bold">{{ __('Tgl Catat') }}</td>
                                            <td>{{ isset($cashTransaction->tgl_catat) ? $cashTransaction->tgl_catat->format('d/m/Y H:i') : ''  }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Jumlah') }}</td>
                                            <td>{{ $cashTransaction->jumlah }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Keterangan') }}</td>
                                            <td>{{ $cashTransaction->keterangan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Akun') }}</td>
                                            <td>{{ $cashTransaction->akun }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Cash Type') }}</td>
                                        <td>{{ $cashTransaction->cash_type ? $cashTransaction->cash_type->nama : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Cash Type') }}</td>
                                        <td>{{ $cashTransaction->cash_type ? $cashTransaction->cash_type->nama : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Account Type') }}</td>
                                        <td>{{ $cashTransaction->account_type ? $cashTransaction->account_type->kd_aktiva : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Dk') }}</td>
                                            <td>{{ $cashTransaction->dk }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $cashTransaction->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $cashTransaction->updated_at->format('d/m/Y H:i') }}</td>
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