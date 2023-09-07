@extends('adminlte::page')
@section('title', __('Bayar Angsuran'))
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-0">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    @if (session('success'))
        <x-adminlte-alert theme="success" title="Success">
            {{session('success')}}
        </x-adminlte-alert>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Bayar Ngsuran</h5>
                            <form action="{{route('loan-payments.bayar')}}" method="POST">
                                @csrf
                                @method('POST')
                                <x-adminlte-input name="tgl_bayar" label="Tanggal" type="date" placeholder="Tanggal" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="pinjam_id" label="Nomor Pinjam" type="text" placeholder="Nomor Pinjaman" value="{{$pinjaman->id}}" label-class="text-lightblue" readonly>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-select name="angsuran_ke" label="Angsuran Ke" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </x-adminlte-select>
                                <x-adminlte-input name="jumlah_bayar" label="Jumlah Angsuran" type="number" placeholder="Jumlah Angsuran" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-select name="kas_id" label="Simpan Ke Kas" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                    <option value="1">Bank Mandiri</option>
                                </x-adminlte-select>
                                <x-adminlte-select name="ket_bayar" label="Angsuran Ke" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                    <option value="Angsuran">Angsuran</option>
                                    <option value="Pelunasan">Pelunasan</option>
                                </x-adminlte-select>

                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @php
                                $heads = ['Kode','Tanggal Bayar','Angsuran Ke','Jumlah Bayar','Keterangan'];
                                @endphp
                                <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$configAngsuran" striped hoverable bordered with-buttons />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection