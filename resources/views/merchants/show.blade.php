@extends('adminlte::page')
@section('title', __('Detail Mitra'))
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
                                    <td colspan="2" class="text-center">
                                        <div class="avatar avatar-xl">
                                            @if ($merchant->avatar == null)
                                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($merchant->email))) }}&s=500" alt="Avatar">
                                            @else
                                            <img src="{{ asset("uploads/images/avatars/$merchant->avatar") }}" alt="Avatar">
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('First Name') }}</td>
                                    <td>{{ $merchant->first_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Last Name') }}</td>
                                    <td>{{ $merchant->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Member Id') }}</td>
                                    <td>{{ $merchant->member_id }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Email') }}</td>
                                    <td>{{ $merchant->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Status') }}</td>
                                    <td>{{ $merchant->status }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Saldo') }}</td>
                                    <td>@rupiah ($saldo)</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Pencairan') }}</td>
                                    <td>@rupiah ($pencairan)</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Sisa Saldo') }}</td>
                                    <td>@rupiah ($saldo - abs($pencairan))</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Role') }}</td>
                                    <td>{{ $merchant->getRoleNames()->toArray() !== [] ? $merchant->getRoleNames()[0] : '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive p-1">
                                            <table class="table table-striped" id="data-table" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('No') }}</th>
                                                        <th>{{ __('Tanggal') }}</th>
                                                        <th>{{ __('Jumlah') }}</th>
                                                        <th>{{ __('Keterangan') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($semuaTransaksi as $transaksi)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$transaksi->created_at}}</td>
                                                        <td>@rupiah($transaksi->amount)</td>
                                                        @php
                                                        $meta = json_decode($transaksi['meta'], true);
                                                        @endphp
                                                        @if ($meta)
                                                        <td>{{ $meta['description']}}</td>
                                                        @else
                                                        <td>Pencairan</td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            Halaman : {{ $semuaTransaksi->currentPage() }} <br />
                                            Jumlah Data : {{ $semuaTransaksi->total() }} <br />
                                            Data Per Halaman : {{ $semuaTransaksi->perPage() }} <br />


                                            {{ $semuaTransaksi->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection