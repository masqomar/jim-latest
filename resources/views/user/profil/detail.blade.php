@extends('layouts.user')

@section('title', trans('Update Profil'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Update Profil</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="row">
    <div class="col-md-12">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            Silahkan periksa kembali inputanmu
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="mb-1">
                            <label>Nama Depan:</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __('Nama Keren') }}" value="{{ old('first_name', auth()->user()->first_name) }}" required>

                            @error('first_name')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label>Nama Lengkap:</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ __('Nama Lengkap') }}" value="{{ old('last_name', auth()->user()->last_name) }}" required>

                            @error('last_name')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                            @error('email')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('New password') }}">

                            @error('password')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label>Konfirmasi Password:</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('New password confirmation') }}" autocomplete="new-password">

                        </div>

                        <div class="mb-1">
                            <label>No Telp: <sup><strong>Tanpa angka 0</strong></sup></label>
                            <input type="number" name="noHp" class="form-control @error('noHp') is-invalid @enderror" value="{{ old('mobile', auth()->user()->mobile) }}" placeholder="{{ __('857 9070 2476') }}">

                            @error('noHp')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        
                        <div class="mb-1">
                            <label>No Rekening:</label>
                            <input type="number" name="noHp" class="form-control @error('noHp') is-invalid @enderror" value="{{ old('others', auth()->user()->others) }}" placeholder="{{ __('Nomor Rekening') }}">

                            @error('noHp')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label>Atas Nama Rekening:</label>
                            <input type="text" name="noHp" class="form-control @error('noHp') is-invalid @enderror" value="{{ old('extra_field', auth()->user()->extra_field) }}" placeholder="{{ __('Rekening atas nama?') }}">

                            @error('noHp')
                            <span class="error invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label>Avatar:</label>
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">

                            @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection