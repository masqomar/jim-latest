@extends('layouts.user')

@section('title', trans('Topup'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Topup</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="row">
    <div class="col-6">
        <a href="#" style="color: white;">
            <div class="card gradasigreen">
                <div class="card-body text-center">
                    <div class="jimAppcontent">
                        <div class="iconjimApp">
                            <ion-icon name="wallet-outline"></ion-icon>
                            <h4 class="jimApptitle">Saldo Sukarela</h4>
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
                    <a href="{{route('user.topup.cash')}}" style="color: white;">
                        <div class="iconjimApp">
                            <ion-icon name="cash-outline"></ion-icon>
                            <h4 class="jimApptitle">Cash / Transfer</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection