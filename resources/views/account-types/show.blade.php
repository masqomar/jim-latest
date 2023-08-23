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
                                            <td class="fw-bold">{{ __('Kd Aktiva') }}</td>
                                            <td>{{ $accountType->kd_aktiva }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Jns Trans') }}</td>
                                            <td>{{ $accountType->jns_trans }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Akun') }}</td>
                                            <td>{{ $accountType->akun }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Laba Rugi') }}</td>
                                            <td>{{ $accountType->laba_rugi }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Pemasukan') }}</td>
                                            <td>{{ $accountType->pemasukan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Pengeluaran') }}</td>
                                            <td>{{ $accountType->pengeluaran }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Aktif') }}</td>
                                            <td>{{ $accountType->aktif }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $accountType->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $accountType->updated_at->format('d/m/Y H:i') }}</td>
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