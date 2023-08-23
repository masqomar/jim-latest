@extends('adminlte::page')
@section('title','Data Angsuran')
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
                    <div class="card-header bg-navy" >
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA ANGSURAN ANGGOTA </h3><br>
                        <hr class="mt-3 mb-0"style="border: 1px solid #fff">
                    </div>
                <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Kode') }}</th>
                                        <th>{{ __('Tanggal Pinjam') }}</th>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Nama Anggota') }}</th>
                                        <th>{{ __('Pokok Pinjaman') }}</th>
                                        <th>{{ __('Tenor') }}</th>
                                        <th>{{ __('Angsuran Pokok') }}</th>
                                        <th>{{ __('Keuntungan Per Bulan') }}</th>
                                        <th>{{ __('Angsuran  Per Bulan') }}</th>
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
        ajax: "{{ route('loan-payments.index') }}",
        columns: [{
                data: 'id',
                name: 'id',
            },
            {
                data: 'kode_transaksi',
                name: 'kode_transaksi',
            },
            {
                data: 'tgl_pinjam',
                name: 'tgl_pinjam',
            },
            {
                data: 'member_id',
                name: 'member_id',
            },
            {
                data: 'first_name',
                name: 'first_name',
            },
            {
                data: 'pokok_pinjaman',
                name: 'pokok_pinjaman',
            },
            {
                data: 'lama_pinjaman',
                name: 'lama_pinjaman',
            },
            {
                data: 'angsuran_pokok',
                name: 'angsuran_pokok',
            },
            {
                data: 'margin',
                name: 'margin',
            },
            {
                data: 'angsuran_bulanan',
                name: 'angsuran_bulanan',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    });
</script>
@endsection