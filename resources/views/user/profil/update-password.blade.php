@extends('layouts.user')

@section('title', trans('Update Password'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack" style="text-decoration:none">
           <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Update Password</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="row">
    <div class="col-md-12">
    @if($errors->any())
        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
        @endif
        @if(Session::get('error') && Session::get('error') != null)
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @php
        Session::put('error', null)
        @endphp
        @endif
        @if(Session::get('success') && Session::get('success') != null)
        <div class="alert alert-success alert-dismissible show fade">{{ Session::get('success') }}</div>
        @php
        Session::put('success', null)
        @endphp
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.profil.changePasswordSave') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="form-group">
                        <label for="password">{{ __('Password Lama') }}</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" placeholder="Password Lama" required>
                        @error('current_password')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password Baru') }}</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="Password Baru" required>
                        @error('new_password')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Ulangi Password Baru') }}</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Ulangi Password Baru" required>
                        @error('new_password_confirmation')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
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