@extends('adminlte::page')

@section('title', 'Setoran Simpanan')

@section('content')
<form class="form" method="get" action="{{ URL::to('/laporan/setoranPdf') }}">
    <div class="row input-daterange">
        <div class="col-md-4">
            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="Dari Tanggal" />
        </div>
        <div class="col-md-4">
            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="Sampai Tanggal" />
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Ekspor</button>
        </div>
    </div>
</form>

@stop