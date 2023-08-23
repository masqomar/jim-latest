@extends('adminlte::page')
@section('title','Laporan Transaksi Kas')
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">L</b>APORAN TRANSAKSI KAS </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Kode Transaksi') }}</th>
                                        <th>{{ __('Tanggal Transaksi') }}</th>
                                        <th>{{ __('Akun Transaksi') }}</th>
                                        <th>{{ __('Dari Kas') }}</th>
                                        <th>{{ __('Untuk Kas') }}</th>
                                        <th>{{ __('Debet') }}</th>
                                        <th>{{ __('Kredit') }}</th>
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
        ajax: "{{ route('cash-transaction-reports.index') }}",
        columns: [{
                data: 'id',
                name: 'id',
            },
            {
                data: 'kode_transaksi',
                name: 'kode_transaksi',
            },
            {
                data: 'tgl',
                name: 'tgl',
            },
            {
                data: 'transaksi',
                name: 'transaksi',
            },
            {
                data: 'dari_kas',
                name: 'dari_kas',
            },
            {
                data: 'untuk_kas',
                name: 'untuk_kas',
            },           
            {
                data: 'debet',
                name: 'debet',
            },
            {
                data: 'kredit',
                name: 'kredit',
            },
        ],
    });
   
</script>
@endsection