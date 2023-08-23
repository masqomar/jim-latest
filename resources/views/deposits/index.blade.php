@extends('adminlte::page')

@section('title', 'Setoran Simpanan')

@section('content')
<div class="content-header">
    <div class="row">
        <div class="col-12">
            @if (session('success'))
            <x-adminlte-alert theme="success" title="Success">
                {{session('success')}}
            </x-adminlte-alert>
            @endif
            <div class="card">
                <div class="card-header bg-navy">
                    <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA SETORAN SIMPANAN </h3>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('deposits.create') }}" class="btn btn-primary sm-3">
                            <i class="fas fa-plus"></i>
                            {{ __('Tambah') }}
                        </a>&nbsp;
                        <a href="{{ route('export-setoran-simpanan') }}" class="btn btn-success sm-3">
                            <i class="fas fa-print"></i>
                            {{ __('Export') }}
                        </a>&nbsp;
                        <button type="button" class="btn btn-info sm-3" data-toggle="modal" data-target="#import">
                            <i class="fas fa-file-excel"></i>
                            {{ __('Import') }}
                        </button>
                    </div>
                    <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="row input-daterange">
                            <div class="col-md-4">
                                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Dari Tanggal" readonly />
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Sampai Tanggal" readonly />
                            </div>
                            <div class="col-md-4">
                                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="order_table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Kode Transaksi') }}</th>
                                        <th>{{ __('Tanggal Transaksi') }}</th>
                                        <th>{{ __('Id Anggota') }}</th>
                                        <th>{{ __('Nama Anggota') }}</th>
                                        <th>{{ __('Jenis Simpanan') }}</th>
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
</div>
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
            <form action="{{ route('import-setoran-simpanan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>PILIH FILE</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('download-sample-setoran-wajib') }}" class="btn btn-info sm-3">
                        <i class="fas fa-file-excel"></i>
                        {{ __('Sample Wajib') }}
                    </a>
                    <a href="{{ route('download-sample-setoran-sukarela') }}" class="btn btn-primary sm-3">
                        <i class="fas fa-file-excel"></i>
                        {{ __('Sample Sukarela') }}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            $('#order_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("deposits.index") }}',
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: 'kode_transaksi',
                        name: 'kode_transaksi',
                    },
                    {
                        data: 'tgl_transaksi',
                        name: 'tgl_transaksi',
                    },
                    {
                        data: 'user.member_id',
                        name: 'user.member_id',
                    },
                    {
                        data: 'user.first_name',
                        name: 'user.first_name',
                    },
                    {
                        data: 'saving_type.jns_simpan',
                        name: 'saving_type.jns_simpan',
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
                ]
            });
        }

        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#order_table').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Both Date is required');
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#order_table').DataTable().destroy();
            load_data();
        });
    });
</script>
@endsection