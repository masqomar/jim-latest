@extends('adminlte::page')

@section('title', 'Data Transaksi Mitra')


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
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA TRANSASKI / PENCAIRAN MITRA </h3>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('merchant-transactions.create') }}" class="btn btn-primary sm-3">
                                <i class="fas fa-plus"></i>
                                {{ __('Cairkan') }}
                            </a>
                        </div>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Tanggal') }}</th>
                                        <th>{{ __('Kode Transaksi') }}</th>
                                        <th>{{ __('Mitra') }}</th>
                                        <th>{{ __('Jumlah') }}</th>
                                        <th>{{ __('Keterangan') }}</th>
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
@stop

@section('js')
<script>
    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('merchant-transactions.index') }}",
        columns: [{
                data: 'kode_transaksi',
                name: 'kode_transaksi'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'jumlah',
                name: 'jumlah'
            },
            {
                data: 'meta',
                name: 'meta'
            },
        ],
    });
</script>
@endsection