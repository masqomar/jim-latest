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
        <a href="{{ route('user.profil.detail') }}" style="color: #0a0a0a; text-decoration:none">
            <div class="item">
                <div class="icon-box bg-info">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="in">
                    <div>Update Profil</div>
                </div>
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('user.profil.update-password') }}" style="color: #0a0a0a; text-decoration:none">
            <div class="item">
                <div class="icon-box bg-primary">
                    <i class="fas fa-key"></i>
                </div>
                <div class="in">
                    <div>Update Password</div>
                </div>
            </div>
        </a>
    </li>
    <li>
        <a style="color: #0a0a0a; text-decoration:none" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <div class="item">
                <div class="icon-box bg-success">
                    <i class="fas fa-sign-out-alt"></i>
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