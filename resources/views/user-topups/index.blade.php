@extends('adminlte::page')
@section('title','Topup JIMPay')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-0">
            <div class="col-sm-6">
                <!-- <h4> Daftar Pengguna  </h4> -->
            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
    
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA TOPUP CASH / TRANSFER JIMPAY </h3>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user-topups.create') }}" class="btn btn-primary sm-3">
                                <i class="fas fa-plus"></i>
                                {{ __('Tambah') }}
                            </a>
                        </div>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Anggota') }}</th>
                                        <th>{{ __('Nominal') }}</th>
                                        <th>{{ __('Tanggal Topup') }}</th>
                                        <th>{{ __('Keterangan') }}</th>
                                        <th>{{ __('Status') }}</th>
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
        ajax: "{{ route('user-topups.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'user',
                name: 'user.first_name'
            },
            {
                data: 'amount',
                name: 'amount',
            },
            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'note',
                name: 'note',
            },
            {
                data: 'status',
                name: 'status',
            },
        ],
    });
</script>
@endsection