@extends('adminlte::page')

@section('title', 'Data Simpanan Sukarela')

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
                            <form action="{{route('devidens.filter')}}" method="get">
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
                                            <th rowspan="2" style="text-align:center;">Total<br>Sukarela</th>
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
                                        $setoran_januari = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '01')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_januari = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '01')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_pebruari = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '02')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_pebruari = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '02')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_maret = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '03')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_maret = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '03')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_april = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '04')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_april = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '04')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_mei = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '05')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_mei = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '05')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_juni = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '06')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_juni = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '06')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_juli = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '07')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_juli = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '07')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_agustus = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '08')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_agustus = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '08')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_september = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '09')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_september = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '09')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_oktober = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '10')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_oktober = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '10')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_nopember = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '11')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_nopember = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '11')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $setoran_desember = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereMonth('tgl_transaksi', '12')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $penarikan_desember = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereMonth('tgl_transaksi', '12')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');

                                        $totalSetoran = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Setoran')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        $totalPenarikan = DB::table('saving_transactions')->where('anggota_id', $anggota->id)->where('jenis_id', 32)->where('akun', 'Penarikan')->whereYear('tgl_transaksi', request()->get('tahun'))->sum('jumlah');
                                        @endphp
                                        <tr>
                                            <th>
                                                {{$anggota->member_id}}
                                            </th>
                                            <th>
                                                {{$anggota->first_name}}
                                            </th>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_januari)}}<br>
                                                Tarik : {{number_format($penarikan_januari)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_pebruari)}}<br>
                                                Tarik : {{number_format($penarikan_pebruari)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_maret)}}<br>
                                                Tarik : {{number_format($penarikan_maret)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_april)}}<br>
                                                Tarik : {{number_format($penarikan_april)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_mei)}}<br>
                                                Tarik : {{number_format($penarikan_mei)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_juni)}}<br>
                                                Tarik : {{number_format($penarikan_juni)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_juli)}}<br>
                                                Tarik : {{number_format($penarikan_juli)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_agustus)}}<br>
                                                Tarik : {{number_format($penarikan_agustus)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_september)}}<br>
                                                Tarik : {{number_format($penarikan_september)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_oktober)}}<br>
                                                Tarik : {{number_format($penarikan_oktober)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_nopember)}}<br>
                                                Tarik : {{number_format($penarikan_nopember)}}
                                            </td>
                                            <td style="font-size: x-small;">
                                                Setor : {{number_format($setoran_desember)}}<br>
                                                Tarik : {{number_format($penarikan_desember)}}
                                            </td>
                                            <td>
                                                {{number_format($totalSetoran - $totalPenarikan)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                Halaman : {{ $users->currentPage() }} <br />
                                Jumlah Data : {{ $users->total() }} <br />
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
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'a4'
            }
        ]
    });
</script>
@endsection