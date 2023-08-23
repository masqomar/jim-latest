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
                                            <td class="fw-bold">{{ __('Opsi Key') }}</td>
                                            <td>{{ $profitSharing->opsi_key }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Opsi Val') }}</td>
                                            <td>{{ $profitSharing->opsi_val }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $profitSharing->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $profitSharing->updated_at->format('d/m/Y H:i') }}</td>
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