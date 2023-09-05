@extends('layouts.user')

@section('title', trans('Pulsa Prabayar'))

@section('content')


<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="pageTitle">Pulsa Prabayar</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<br>
<br>
<br>
<div class="col-md-12">
    @if($errors->any())
    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
    @endif
    @if(Session::get('error') && Session::get('error') != null)
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @php
    Session::put('error', null)
    @endphp
    @endif
    @if(Session::get('success') && Session::get('success') != null)
    <div class="alert alert-success alert-dismissible show fade">{{ Session::get('success') }}</div>
    @php
    Session::put('success', null)
    @endphp
    @endif
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pulsa Indosat</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Data Indosat</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Pulsa Telkomsel</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pulsaByu-tab" data-bs-toggle="tab" data-bs-target="#pulsaByu" type="button" role="tab" aria-controls="pulsaByu" aria-selected="false">Pulsa By. U</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row row-cols-2">
                        @foreach ($allPulsa as $pulsaPrabayar)
                        @if($pulsaPrabayar->brand == 'INDOSAT' && $pulsaPrabayar->kategori == 'Pulsa')
                        <div class="text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{$pulsaPrabayar->nama_produk}}</h5>
                                    <p class="card-text">{{$pulsaPrabayar->deskripsi}}</p>
                                    <span class="badge rounded-pill bg-info text-dark">Harga: {{number_format($pulsaPrabayar->margin)}}</span>
                                </div>
                                <form action="{{route('user.pulsa-data.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="sku" value="{{$pulsaPrabayar->sku}}">
                                    <input type="hidden" name="nama_produk" value="{{$pulsaPrabayar->nama_produk}}">
                                    <label>Nomor<sup><a href="#" data-toggle="tooltip" title="Tanpa angka 0">Tanpa angka 0</a></sup></label>
                                    <input type="number" class="form-control" name="nomor" placeholder="Masukan nomor Telepon" value="{{Auth::user()->mobile}}" required>
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row row-cols-2">
                        @foreach ($allPulsa as $pulsaPrabayar)
                        @if($pulsaPrabayar->brand == 'INDOSAT' && $pulsaPrabayar->kategori == 'Data')
                        <div class="text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{$pulsaPrabayar->nama_produk}}</h5>
                                    <p class="card-text">{{$pulsaPrabayar->deskripsi}}</p>
                                    <span class="badge rounded-pill bg-info text-dark">Harga: {{number_format($pulsaPrabayar->margin)}}</span>
                                </div>
                                <form action="{{route('user.pulsa-data.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="sku" value="{{$pulsaPrabayar->sku}}">
                                    <input type="hidden" name="nama_produk" value="{{$pulsaPrabayar->nama_produk}}">
                                    <label>Nomor<sup><a href="#" data-toggle="tooltip" title="Tanpa angka 0">Tanpa angka 0</a></sup></label>
                                    <input type="number" class="form-control" name="nomor" placeholder="Masukan nomor Telepon" value="{{Auth::user()->mobile}}" required>
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row row-cols-2">
                        @foreach ($allPulsa as $pulsaPrabayar)
                        @if($pulsaPrabayar->brand == 'TELKOMSEL' && $pulsaPrabayar->kategori == 'Pulsa')
                        <div class="text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{$pulsaPrabayar->nama_produk}}</h5>
                                    <p class="card-text">{{$pulsaPrabayar->deskripsi}}</p>
                                    <span class="badge rounded-pill bg-info text-dark">Harga: {{number_format($pulsaPrabayar->margin)}}</span>
                                </div>
                                <form action="{{route('user.pulsa-data.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="sku" value="{{$pulsaPrabayar->sku}}">
                                    <input type="hidden" name="nama_produk" value="{{$pulsaPrabayar->nama_produk}}">
                                    <label>Nomor<sup><a href="#" data-toggle="tooltip" title="Tanpa angka 0">Tanpa angka 0</a></sup></label>
                                    <input type="number" class="form-control" name="nomor" placeholder="Masukan nomor Telepon" value="{{Auth::user()->mobile}}" required>
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="pulsaByu" role="tabpanel" aria-labelledby="pulsaByu-tab">
                    <div class="row row-cols-2">
                        @foreach ($allPulsa as $pulsaPrabayar)
                        @if($pulsaPrabayar->brand == 'by.U' && $pulsaPrabayar->kategori == 'Pulsa')
                        <div class="text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{$pulsaPrabayar->nama_produk}}</h5>
                                    <p class="card-text">{{$pulsaPrabayar->deskripsi}}</p>
                                    <span class="badge rounded-pill bg-info text-dark">Harga: {{number_format($pulsaPrabayar->margin)}}</span>
                                </div>
                                <form action="{{route('user.pulsa-data.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="sku" value="{{$pulsaPrabayar->sku}}">
                                    <input type="hidden" name="nama_produk" value="{{$pulsaPrabayar->nama_produk}}">
                                    <label>Nomor<sup><a href="#" data-toggle="tooltip" title="Tanpa angka 0">Tanpa angka 0</a></sup></label>
                                    <input type="number" class="form-control" name="nomor" placeholder="Masukan nomor Telepon" value="{{Auth::user()->mobile}}" required>
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection