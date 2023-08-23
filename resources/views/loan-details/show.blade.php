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
                                            <td class="fw-bold">{{ __('Tgl Bayar') }}</td>
                                            <td>{{ isset($loanDetail->tgl_bayar) ? $loanDetail->tgl_bayar->format('d/m/Y H:i') : ''  }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Loan') }}</td>
                                        <td>{{ $loanDetail->loan ? $loanDetail->loan->tgl_pinjam : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Angsuran Ke') }}</td>
                                            <td>{{ $loanDetail->angsuran_ke }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Jumlah Bayar') }}</td>
                                            <td>{{ $loanDetail->jumlah_bayar }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Denda Rp') }}</td>
                                            <td>{{ $loanDetail->denda_rp }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Terlambat') }}</td>
                                            <td>{{ $loanDetail->terlambat }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Ket Bayar') }}</td>
                                            <td>{{ $loanDetail->ket_bayar }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Dk') }}</td>
                                            <td>{{ $loanDetail->dk }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Cash Type') }}</td>
                                        <td>{{ $loanDetail->cash_type ? $loanDetail->cash_type->nama : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Account Type') }}</td>
                                        <td>{{ $loanDetail->account_type ? $loanDetail->account_type->kd_aktiva : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $loanDetail->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $loanDetail->updated_at->format('d/m/Y H:i') }}</td>
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