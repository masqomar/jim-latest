@extends('adminlte::page')
@section('title', __('Submissions'))
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
                                <a href="{{ route('submissions.create') }}" class="btn btn-primary sm-3">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Tambah') }}
                                </a>
                            </div>
                            <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                        </div>
                    
                        <div class="card-body">                    
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                        <th>{{ __('No Ajuan') }}</th>
											<th>{{ __('Ajuan Id') }}</th>
											<th>{{ __('User') }}</th>
											<th>{{ __('Tgl Input') }}</th>
											<th>{{ __('Jenis') }}</th>
											<th>{{ __('Nominal') }}</th>
											<th>{{ __('Lama Ags') }}</th>
											<th>{{ __('Keterangan') }}</th>
											<th>{{ __('Status') }}</th>
											<th>{{ __('Alasan') }}</th>
											<th>{{ __('Tgl Cair') }}</th>
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
            ajax: "{{ route('submissions.index') }}",
            columns: [
                {
                    data: 'no_ajuan',
                    name: 'no_ajuan',
                },
				{
                    data: 'ajuan_id',
                    name: 'ajuan_id',
                },
				{
                    data: 'user',
                    name: 'user.first_name'
                },
				{
                    data: 'tgl_input',
                    name: 'tgl_input',
                },
				{
                    data: 'jenis',
                    name: 'jenis',
                },
				{
                    data: 'nominal',
                    name: 'nominal',
                },
				{
                    data: 'lama_ags',
                    name: 'lama_ags',
                },
				{
                    data: 'keterangan',
                    name: 'keterangan',
                },
				{
                    data: 'status',
                    name: 'status',
                },
				{
                    data: 'alasan',
                    name: 'alasan',
                },
				{
                    data: 'tgl_cair',
                    name: 'tgl_cair',
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