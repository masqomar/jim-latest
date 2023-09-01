@extends('layouts.user')

@section('title', trans('Riwayat Transaksi'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
           <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Riwayat Transaksi</div>
    <div class="right"></div>
</div>

<!-- * App Header -->
<br>
<br>
<br>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table class="table table-striped" id="data-table">
                    <thead>
                        <tr>
                            <th class="text-center" width=30%>Tanggal</th>
                            <th class="text-center" width=30%>Nominal</th>
                            <th class="text-center" width=40%>Keterangan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>

    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('mitra.riwayat-transaksi.index') }}",
            columns: [
                {
                    data: 'created_at',
                    name: 'created_at',
                },
				{
                    data: 'amount',
                    name: 'amount',
                },
				{
                    data: 'meta',
                    name: 'meta',
                },
            ],
        });
    </script>
    @endsection