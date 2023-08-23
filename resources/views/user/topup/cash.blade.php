@extends('layouts.user')

@section('title', trans('Topup Cash'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Topup Cash</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="section mt-1 mb-5">
    <form action="{{ route('user.topup.store') }}" method="POST" id="logForm">
        {{ csrf_field() }}

        <div class="form-group">
            @error('login_gagal')
            {{-- <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
            </span> --}}
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{-- <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span> --}}
                <span class="alert-inner--text"><strong>Warning!</strong> {{ $message }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
        </div>

        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="number" class="form-control" name="nominal_topup" min="10000" placeholder="Masukan Nominal Topup" required>
                <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
                </i>
            </div>
            @if($errors->has('nominal_topup'))
            <span class="error">{{ $errors->first('nominal_topup') }}</span>
            @endif
        </div>
        <div class="alert alert-warning">
            <div class="media">
                <div class="icon icon-40 bg-white text-success mr-2 rounded-circle"></div>
                <div class="media-inner">
                    <h6 class="mb-0 font-weight-normal">
                        <p>Bisa juga topup manual (cash) melalui koperasi di New Building</p>
                        <p>Berlaku di jam <b>07.00 - 17.00 WIB</b></p>

                        <p>atau topup otomatis menggunakan saldo Simpanan Sukarela <a href="#">Klik aku disini ya...</a> </p>
                        <p>Transaksi <b>24 jam Non-Stop</b></p>
                    </h6>
                </div>
            </div>
        </div>
        <br>
        <button class="btn btn-sm btn-primary w-100 d-flex align-items-center justify-content-center" type="submit">Top Up Sekarang
        </button>
</div>
@endsection