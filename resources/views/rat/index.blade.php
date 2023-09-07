@extends('adminlte::page')
@section('title', __('Laporan Rapat Akhir Tahun'))
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">T</b>AMBAH </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <div class="card-body">
                        <form action="{{url('rat/pdf')}}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <x-adminlte-input name="tanggal" label="Tanggal" type="date" placeholder="Tanggal" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="far fa-calendar-alt text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6">
                                    <x-adminlte-input name="ketua" label="Ketua" type="text" placeholder="Ketua" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-tag text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6">
                                    <x-adminlte-input name="sekretaris" label="Sekretaris" type="text" placeholder="Sekretaris" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-diagnoses text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection