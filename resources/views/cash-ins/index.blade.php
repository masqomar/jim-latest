@extends('adminlte::page')
@section('title', __('Pemasukan Kas'))
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA PEMASUKAN KAS</h3>

                        @can('pemasukan kas create')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('cash-ins.create') }}" class="btn btn-primary float-end">
                                <i class="fas fa-plus"></i>
                                {{ __('Tambah') }}
                            </a>&nbsp;
                            <a href="{{ route('export-kas-masuk') }}" class="btn btn-success sm-3">
                            <i class="fas fa-print"></i>
                            {{ __('Export') }}
                        </a>&nbsp;
                        <button type="button" class="btn btn-info sm-3" data-toggle="modal" data-target="#import">
                            <i class="fas fa-file-excel"></i>
                            {{ __('Import') }}
                        </button>
                        </div>
                        @endcan
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Kode Transaksi') }}</th>
                                        <th>{{ __('Tanggal Transaksi') }}</th>
                                        <th>{{ __('Uraian') }}</th>
                                        <th>{{ __('Untuk Kas') }}</th>
                                        <th>{{ __('Dari Akun') }}</th>
                                        <th>{{ __('Jumlah') }}</th>
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
<!-- modal -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('import-pemasukan-kas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>PILIH FILE</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('download-sample-pemasukan-kas') }}" class="btn btn-info sm-3">
                        <i class="fas fa-file-excel"></i>
                        {{ __('Sample Pemasukan') }}
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-success">IMPORT</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



@section('js')

<script>
    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('cash-ins.index') }}",
        columns: [{
                data: 'kode_transaksi',
                name: 'kode_transaksi',
            },
            {
                data: 'tgl_catat',
                name: 'tgl_catat',
            },
            {
                data: 'keterangan',
                name: 'keterangan',
            },
            {
                data: 'to_cash_type.nama',
                name: 'to_cash_type.nama',
            },
            {
                data: 'account_type.jns_trans',
                name: 'account_type.jns_trans',
            },
            {
                data: 'jumlah',
                name: 'jumlah',
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