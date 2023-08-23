@extends('adminlte::page')
@section('title', __('Detail Anggota'))
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
                                            @if ($user->avatar == null)
                                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}&s=500" alt="Avatar">
                                            @else
                                            <img src="{{ asset("uploads/images/avatars/$user->avatar") }}" alt="Avatar">
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('First Name') }}</td>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Last Name') }}</td>
                                    <td>{{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Member Id') }}</td>
                                    <td>{{ $user->member_id }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Email') }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Status') }}</td>
                                    <td>{{ $user->status }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Role') }}</td>
                                    <td>{{ $user->getRoleNames()->toArray() !== [] ? $user->getRoleNames()[0] : '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection