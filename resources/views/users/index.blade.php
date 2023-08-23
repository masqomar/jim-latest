@extends('adminlte::page')
@section('title', __('Data Anggota'))
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
                @if (session('success'))
                <x-adminlte-alert theme="success" title="Success">
                    {{session('success')}}
                </x-adminlte-alert>
                @endif

                <div class="card">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA </h3>
                        
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('users.create') }}" class="btn btn-primary float-end">
                                <i class="fas fa-plus"></i>
                                {{ __('Tambah') }}
                            </a>&nbsp;&nbsp;
                            <a href="{{ route('export-anggota') }}" class="btn btn-success sm-3">
                                <i class="fas fa-print"></i>
                                {{ __('Export') }}
                            </a>
                        </div>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        <th>{{ __('Avatar') }}</th>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Nama') }}</th>
                                        <th>{{ __('No Anggota') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('js')

<script>
    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [{
                data: 'avatar',
                name: 'avatar',
                orderable: false,
                searchable: false,
                render: function(data, type, full, meta) {
                    return `<div class="avatar">
                            <img src="${data}" alt="avatar">
                        </div>`;
                }
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'member_id',
                name: 'member_id'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                witdh: '15%'
            }
        ],
    });
</script>
@endsection