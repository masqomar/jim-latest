@extends('layouts.user')

@section('title', trans('Profil'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
           <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Profil</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<br>
<br>
<br>
<ul class="listview image-listview">
    <li>
        <a href="{{ route('user.profil.detail') }}" style="color: #0a0a0a">
            <div class="item">
                <div class="icon-box bg-info">
                    <ion-icon name="person"></ion-icon>
                </div>
                <div class="in">
                    <div>Edit Profil</div>
                </div>
            </div>
        </a>
    </li>
    <li>
        <a style="color: #0a0a0a" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <div class="item">
                <div class="icon-box bg-success">
                    <ion-icon name="log-out"></ion-icon>
                </div>
                <div class="in">
                    <div>Logout</div>
                </div>
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>

@endsection