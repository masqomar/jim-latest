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
@if ($message = Session::get('success'))
<div class="alert alert-info alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif
<br>
<div class="row">
    <div class="col-6">
        <a href="{{route('user.transfer.scantransfer')}}" style="color: white;">
            <div class="card gradasigreen">
                <div class="card-body text-center">
                    <div class="jimAppcontent">
                        <div class="iconjimApp">
                            <ion-icon name="scan"></ion-icon>
                            <h4 class="jimApptitle">Scan QR</h4>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6">
        <div class="card gradasired">
            <div class="card-body text-center">
                <div class="jimAppcontent">
                    <a href="{{route('user.transfer.manual')}}" style="color: white;">
                        <div class="iconjimApp">
                            <ion-icon name="pencil"></ion-icon>
                            <h4 class="jimApptitle">Manual</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection