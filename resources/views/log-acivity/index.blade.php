@extends('adminlte::page')
@section('title','Log Activity')
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
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA LOG ACTIVITY </h3><br>
                        <hr class="mt-3 mb-0"style="border: 1px solid #fff">
                    </div>
                <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                    <th>{{ __('Id') }}</th>
                                        <th>{{ __('Aktifitas') }}</th>
                                        <th>{{ __('Keterangan') }}</th>
                                        <th>{{ __('Eksekutor') }}</th>
                                        <th>{{ __('Waktu') }}</th>
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
        ajax: "{{ route('activities.index') }}",
        columns: [{
                data: 'id',
                name: 'id',
            },
            {
                data: 'log_name',
                name: 'log_name',
            },
            {
                data: 'properties',
                name: 'properties',
            },
            {
                data: 'user',
                name: 'user',
            },
            {
                data: 'waktu',
                name: 'waktu',
            },

        ],
    });
</script>
@endsection