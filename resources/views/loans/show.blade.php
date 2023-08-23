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
                                            <td class="fw-bold">{{ __('Tgl Pinjam') }}</td>
                                            <td>{{ isset($loan->tgl_pinjam) ? $loan->tgl_pinjam->format('d/m/Y H:i') : ''  }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $loan->user ? $loan->user->first_name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Kop Product') }}</td>
                                        <td>{{ $loan->kop_product ? $loan->kop_product->nm_barang : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Lama Angsuran') }}</td>
                                            <td>{{ $loan->lama_angsuran }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Jumlah') }}</td>
                                            <td>{{ $loan->jumlah }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Bunga') }}</td>
                                            <td>{{ $loan->bunga }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Biaya Adm') }}</td>
                                            <td>{{ $loan->biaya_adm }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Lunas') }}</td>
                                            <td>{{ $loan->lunas }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Dk') }}</td>
                                            <td>{{ $loan->dk }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Cash Type') }}</td>
                                        <td>{{ $loan->cash_type ? $loan->cash_type->nama : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Cash Type') }}</td>
                                        <td>{{ $loan->cash_type ? $loan->cash_type->nama : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $loan->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $loan->updated_at->format('d/m/Y H:i') }}</td>
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