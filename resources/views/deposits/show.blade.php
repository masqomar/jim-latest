@extends('adminlte::page')

@section('title', 'Detail Setoran Simpanan')

@section('content_header')
<div class="card-header bg-navy">
    <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ETAIL SETORAN SIMPANAN </h3>
   <br>
    <hr class="mt-3 mb-0" style="border: 1px solid #fff">
</div>
@stop
@section('content')
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
                                            <td>{{ isset($deposit->tgl_transaksi) ? $deposit->tgl_transaksi->format('d/m/Y H:i') : ''  }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $deposit->user ? $deposit->user->first_name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Saving Type') }}</td>
                                        <td>{{ $deposit->saving_type ? $deposit->saving_type->jns_simpan : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Jumlah') }}</td>
                                            <td>{{ $deposit->jumlah }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Akun') }}</td>
                                            <td>{{ $deposit->akun }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Dk') }}</td>
                                            <td>{{ $deposit->dk }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Cash Type') }}</td>
                                        <td>{{ $deposit->cash_type ? $deposit->cash_type->nama : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $deposit->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $deposit->updated_at->format('d/m/Y H:i') }}</td>
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