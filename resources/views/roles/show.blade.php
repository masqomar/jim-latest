@extends('adminlte::page')
@section('title', __('Cash Transactions'))
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
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Permissions') }}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            @foreach ($role->permissions as $permission)
                                            <li class="list-inline-item ">• {{ $permission->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
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