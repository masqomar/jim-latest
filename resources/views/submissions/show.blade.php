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
                                            <td class="fw-bold">{{ __('No Ajuan') }}</td>
                                            <td>{{ $submission->no_ajuan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Ajuan Id') }}</td>
                                            <td>{{ $submission->ajuan_id }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $submission->user ? $submission->user->first_name : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tgl Input') }}</td>
                                            <td>{{ isset($submission->tgl_input) ? $submission->tgl_input->format('d/m/Y H:i') : ''  }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Jenis') }}</td>
                                            <td>{{ $submission->jenis }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Nominal') }}</td>
                                            <td>{{ $submission->nominal }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Lama Ags') }}</td>
                                            <td>{{ $submission->lama_ags }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Keterangan') }}</td>
                                            <td>{{ $submission->keterangan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Status') }}</td>
                                            <td>{{ $submission->status }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Alasan') }}</td>
                                            <td>{{ $submission->alasan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tgl Cair') }}</td>
                                            <td>{{ isset($submission->tgl_cair) ? $submission->tgl_cair->format('d/m/Y') : ''  }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $submission->updated_at->format('d/m/Y H:i') }}</td>
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