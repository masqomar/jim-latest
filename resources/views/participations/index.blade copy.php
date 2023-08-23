@extends('adminlte::page')

@section('title', 'Data Transaksi JIMPay')

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
                        <div class="col-md-12">
                            <form action="{{route('participations.filter')}}" method="get">
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="number" name="tahun" class="form-control">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:25px;">
                                        <input type="submit" class="btn btn-primary" value="Search">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Table row -->
                        <div class="row">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="myTable" width="100%">
                                    <thead>
                                        <tr class="table-danger">
                                            <th rowspan="2" colspan="2" style="text-align:center;">Identitas<br>Anggota</th>
                                            <th colspan="12" style="text-align:center;">Simpanan</th>
                                            <th rowspan="2" style="text-align:center;">Total<br>Transaksi</th>
                                        </tr>
                                        <tr class="table-danger">
                                            <th style="text-align:center;">Jan</th>
                                            <th style="text-align:center;">Peb</th>
                                            <th style="text-align:center;">Mar</th>
                                            <th style="text-align:center;">Apr</th>
                                            <th style="text-align:center;">Mei</th>
                                            <th style="text-align:center;">Jun</th>
                                            <th style="text-align:center;">Jul</th>
                                            <th style="text-align:center;">Ags</th>
                                            <th style="text-align:center;">Sep</th>
                                            <th style="text-align:center;">Okt</th>
                                            <th style="text-align:center;">Nop</th>
                                            <th style="text-align:center;">Des</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $anggota)
                                        @php
                                        $deposit_januari = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '01')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_januari = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '01')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_pebruari = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '02')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_pebruari = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '02')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_maret = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '03')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_maret = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '03')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_april = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '04')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_april = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '04')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_mei = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '05')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_mei = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '05')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_juni = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '06')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_juni = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '06')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_juli = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '07')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_juli = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '07')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_agustus = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '08')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_agustus = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '08')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_september = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '09')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_september = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '09')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_oktober = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '10')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_oktober = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '10')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_nopember = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '11')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_nopember = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '11')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $deposit_desember = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '12')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        $withdraw_desember = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereMonth('created_at', '12')->whereYear('created_at', request()->get('tahun'))->sum('amount');

                                        $totalDeposit = DB::table('transactions')->where('payable_id', $anggota->id)->where('type', 'deposit')->whereYear('created_at', request()->get('tahun'))->sum('amount');
                                        @endphp
                                        <tr>
                                            <th>
                                                {{$anggota->member_id}}
                                            </th>
                                            <th>                                                
                                            {{$anggota->first_name}}
                                            </th>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_januari)}}<br>
                                                Belanja : {{number_format($withdraw_januari)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_pebruari)}}<br>
                                                Belanja : {{number_format($withdraw_pebruari)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_maret)}}<br>
                                                Belanja : {{number_format($withdraw_maret)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_april)}}<br>
                                                Belanja : {{number_format($withdraw_april)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_mei)}}<br>
                                                Belanja : {{number_format($withdraw_mei)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_juni)}}<br>
                                                Belanja : {{number_format($withdraw_juni)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_juli)}}<br>
                                                Belanja : {{number_format($withdraw_juli)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_agustus)}}<br>
                                                Belanja : {{number_format($withdraw_agustus)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_september)}}<br>
                                                Belanja : {{number_format($withdraw_september)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_oktober)}}<br>
                                                Belanja : {{number_format($withdraw_oktober)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_nopember)}}<br>
                                                Belanja : {{number_format($withdraw_nopember)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Topup : {{number_format($deposit_desember)}}<br>
                                                Belanja : {{number_format($withdraw_desember)}}
                                            </td>
                                            <td>
                                                {{number_format($totalDeposit)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                Halaman : {{ $users->currentPage() }} <br />
                                amount Data : {{ $users->total() }} <br />
                                Data Per Halaman : {{ $users->perPage() }} <br />
                                {{ $users->appends(['tahun' => request()->get('tahun')])->links() }}

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
@section('js')
<script>
$('#myTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel',            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'a4'
            }
    ]
} );
</script>
@endsection