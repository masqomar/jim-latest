@extends('layouts.user')

@section('title', trans('Konfirmasi Topup'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
           <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Konfirmasi Topup</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="section mt-1 mb-5">
    <div class="alert alert-success text-center">
        <div class="icon icon-40 bg-white text-success mr-2 rounded-circle"></div>
        <div class="media-inner">
            <h6 class="mb-0 font-weight-normal">
                <p>
                    Silahkan transfer ke rekening di bawah ini:
                </p>
                <p><b>4234324234</b></p>

                <p>Sebesar</a> </p>
                <p>Rp. <b>nominal kamu</b></p>
                <p>dan dikirmkan bukti transfer kepada admin</p>
            </h6>
        </div>
    </div>
    <br>
    <a href="https://wa.me/6285790702476" class="btn btn-sm btn-info w-100 d-flex align-items-center justify-content-center">Kirim Bukti Transfer Now!</a>
    <br>
    <a href="{{url('/')}}" class="btn btn-sm btn-danger w-100 d-flex align-items-center justify-content-center">Home</a>
</div>
@endsection