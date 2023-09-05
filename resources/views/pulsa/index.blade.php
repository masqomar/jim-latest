@extends('adminlte::page')
@section('title', __('Data Pulsa'))
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
                @if (session('success'))
                <x-adminlte-alert theme="success" title="Success">
                    {{session('success')}}
                </x-adminlte-alert>
                @endif
                @if (session('error'))
                <x-adminlte-alert theme="success" title="Success">
                    {{session('error')}}
                </x-adminlte-alert>
                @endif
                <div class="card">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">T</b>AMBAH </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pulsa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="row mb-2">
                                @foreach ($produkPulsa as $pulsa)
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="brand">{{ __('Operator') }}</label>
                                        <input type="text" name="brand[]" id="brand" class="form-control @error('brand') is-invalid @enderror" placeholder="{{ __('Nama Operator') }}" value="{{$pulsa['brand']}}" readonly>
                                        @error('brand')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="kategori[]" value="{{$pulsa['kategori']}}">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="sku">{{ __('Sku') }}</label>
                                        <input type="text" name="sku[]" id="sku" class="form-control @error('sku') is-invalid @enderror" placeholder="{{ __('Kode Produk') }}" value="{{$pulsa['sku']}}" readonly>
                                        @error('sku')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama_produk">{{ __('Nama Produk') }}</label>
                                        <input type="text" name="nama_produk[]" id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="{{ __('Tulis Nama Produk') }}" value="{{$pulsa['nama_produk']}}">
                                        @error('nama_produk')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="harga">{{ __('Harga') }}</label>
                                        <input type="text" name="harga[]" id="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="{{ __('Nama Produk') }}" value="{{$pulsa['harga']}}" readonly>
                                        @error('harga')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="margin">{{ __('Harga Jual') }}</label>
                                        <input type="number" name="margin[]" id="margin" class="form-control @error('margin') is-invalid @enderror" placeholder="{{ __('Margin') }}" value="300">
                                        @error('margin')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="deskripsi">{{ __('Deskripsi') }}</label>
                                        <input type="text" name="deskripsi[]" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="{{ __('Deskripsi') }}" value="{{$pulsa['nama_produk']}}" readonly>
                                        @error('deskripsi')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection