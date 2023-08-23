@extends('adminlte::page')
@section('title', __('Saving Types'))
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
                                <a href="{{ route('saving-types.create') }}" class="btn btn-primary sm-3">
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
                                        <th>{{ __('Jns Simpan') }}</th>
											<th>{{ __('Jumlah') }}</th>
											<th>{{ __('Tampil') }}</th>
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
            ajax: "{{ route('saving-types.index') }}",
            columns: [
                {
                    data: 'jns_simpan',
                    name: 'jns_simpan',
                },
				{
                    data: 'jumlah',
                    name: 'jumlah',
                },
				{
                    data: 'tampil',
                    name: 'tampil',
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