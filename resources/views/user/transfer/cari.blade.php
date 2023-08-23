@extends('layouts.user')

@section('title', trans('Transfer'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Transfer</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
@forelse($anggota as $detailAnggota)
<h4 class="text-center"> Transfer ke!
    <h4 class="text-center text-info"><strong>{{$detailAnggota->first_name}}<br />
            {{$detailAnggota->member_id}}</strong>
    </h4>
</h4>

<div class="section mt-1 mb-5">
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <form action="{{ route('user.transfer.kirimSaldo') }}" method="POST">
        @csrf
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="number" class="form-control" name="nominal_transfer" min="1000" placeholder="Masukan Nominal Transfer" required>
                <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
                </i>
            </div>
            @if($errors->has('nominal_transfer'))
            <span class="error">{{ $errors->first('nominal_transfer') }}</span>
            @endif
        </div>
        <input class="form-control" type="hidden" name="anggota_id" value="{{$detailAnggota->id}}" required>
        <input class="form-control" type="hidden" name="member_id" value="{{$detailAnggota->member_id}}" required>
        <div class="form-group basic">
            <input type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center" value="Transfer">
        </div>
    </form>
    @empty
    <div class="alert alert-warning">
        <div class="media">
            <div class="icon icon-40 bg-white text-success mr-2 rounded-circle"></div>
            <div class="media-inner">
                <h1 class="text-center">
                    <small>Kode QR tidak ditemukan</small>
                </h1>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="text-center">
        <a class="btn btn-sm btn-primary" href="{{route('user.transfer.scantransfer')}}" role="button">Scan Ulang</a>
        <a class="btn btn-sm btn-success" href="{{url('/')}}" role="button">Batal</a>
    </div>
    @endforelse
    @endsection