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
                                            <td class="fw-bold">{{ __('Nama') }}</td>
                                            <td>{{ $cashType->nama }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Aktif') }}</td>
                                            <td>{{ $cashType->aktif }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tmpl Simpan') }}</td>
                                            <td>{{ $cashType->tmpl_simpan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tmpl Penarikan') }}</td>
                                            <td>{{ $cashType->tmpl_penarikan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tmpl Pinjaman') }}</td>
                                            <td>{{ $cashType->tmpl_pinjaman }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tmpl Bayar') }}</td>
                                            <td>{{ $cashType->tmpl_bayar }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tmpl Pemasukan') }}</td>
                                            <td>{{ $cashType->tmpl_pemasukan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tmpl Pengeluaran') }}</td>
                                            <td>{{ $cashType->tmpl_pengeluaran }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tmpl Transfer') }}</td>
                                            <td>{{ $cashType->tmpl_transfer }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $cashType->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $cashType->updated_at->format('d/m/Y H:i') }}</td>
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