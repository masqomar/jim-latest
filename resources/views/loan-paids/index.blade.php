@extends('adminlte::page')
@section('title','Data Pinjaman Lunas')
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
                @if (session('success'))
                <x-adminlte-alert theme="success" title="Success">
                    {{session('success')}}
                </x-adminlte-alert>
                @endif
                <div class="card ">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">D</b>ATA PINJAMAN LUNAS </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="myTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Kode') }}</th>
                                        <th>{{ __('Nama Anggota') }}</th>
                                        <th>{{ __('Tanggal Pinjam') }}</th>
                                        <th>{{ __('Tanggal Tempo') }}</th>
                                        <th>{{ __('Lama Pinjam') }}</th>
                                        <th>{{ __('Total Tagihan') }}</th>
                                        <th>{{ __('Di Bayar') }}</th>
                                        <th>{{ __('Selisih') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pinjamanLunas as $lunas)
                                    @php
                                    $pokokAngsuran = ceil($lunas->jumlah / $lunas->lama_angsuran);
                                    $margin = $lunas->biaya_adm;
                                    $totalAngsuran = $pokokAngsuran + $margin;
                                    $totalTagihan = $totalAngsuran * $lunas->lama_angsuran;
                                    $selisih = $totalTagihan - $lunas->sudah_bayar;
                                    @endphp
                                    <tr>
                                        <td>{{'TPJ' . str_pad($lunas->id, 5, '0', STR_PAD_LEFT)}}</td>
                                        <td>{{$lunas->member_id}} - {{$lunas->first_name}}</td>
                                        <td>{{date('j \\ F Y', strtotime($lunas->tgl_pinjam))}}</td>
                                        <td>{{ date('j \\ F Y', strtotime(\Carbon\Carbon::parse($lunas->tgl_pinjam)->addMonth($lunas->lama_angsuran))) }}</td>
                                        <td>{{$lunas->lama_angsuran}} bulan</td>
                                        <td>Rp. {{number_format($totalTagihan)}}</td>
                                        <td>Rp. {{number_format($lunas->sudah_bayar)}}</td>
                                        @if ($selisih < 0) <td class="bg-info">Rp. {{number_format($selisih)}}</td>
                                            @elseif ($selisih > 0)
                                            <td class="bg-danger">Rp. {{number_format($selisih)}}</td>
                                            @else
                                            <td class="bg-primary">Rp. {{number_format($selisih)}}</td>
                                            @endif
                                            <td>aaa</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        Halaman : {{ $pinjamanLunas->currentPage() }} <br />
                        Jumlah Data : {{ $pinjamanLunas->total() }} <br />
                        Data Per Halaman : {{ $pinjamanLunas->perPage() }} <br />


                        {{ $pinjamanLunas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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