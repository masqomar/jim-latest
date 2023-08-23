@extends('adminlte::page')

@section('title', 'Data SHU')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> AdminLTE, Inc.
                                        <small class="float-right">Date: 2/10/2014</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>Admin, Inc.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (804) 123-5432<br>
                                        Email: info@almasaeedstudio.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>John Doe</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (555) 539-1037<br>
                                        Email: john.doe@example.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> 4F3S8J<br>
                                    <b>Payment Due:</b> 2/22/2014<br>
                                    <b>Account:</b> 968-34567
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-bordered mb-5">
                                        <thead>
                                            <tr class="table-danger">
                                                <th rowspan="2">Anggota</th>
                                                <th colspan="12">Simpanan</th>
                                            </tr>
                                            <tr>
                                                <th>Jan</th>
                                                <th>Peb</th>
                                                <th>Mar</th>
                                                <th>Apr</th>
                                                <th>Mei</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ags</th>
                                                <th>Sep</th>
                                                <th>Okt</th>
                                                <th>Nop</th>
                                                <th>Des</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $anggota)
                                            <tr>
                                                <th>
                                                    No Id : {{$anggota->member_id}}<br>
                                                    Nama : {{$anggota->first_name}}<br>
                                            </th>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                                <td>sd</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection