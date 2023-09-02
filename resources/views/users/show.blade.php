@extends('adminlte::page')
@section('title', __('Detail Anggota'))
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
                    @if ($user->avatar == null)
                    <x-adminlte-profile-widget class="elevation-4" name="{{ $user->first_name }}" desc="{{ $user->member_id }}" img="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}&s=500" cover="https://picsum.photos/id/541/550/200" header-class="text-white text-right" footer-class='bg-gradient-dark'>
                        <x-adminlte-profile-row-item title="{{ $user->getRoleNames()->toArray() !== [] ? $user->getRoleNames()[0] : '-' }} - {{$user->date}}" class="text-center border-bottom border-secondary" />
                        <x-adminlte-profile-col-item title="Setoran" text="{{number_format($totalSetoran)}}" icon="fas fa-2x fa-arrow-down text-orange" size=3 />
                        <x-adminlte-profile-col-item title="Penarikan" text="{{number_format($totalPenarikan)}}" icon="fas fa-2x fa-arrow-up text-orange" size=3 />
                        <x-adminlte-profile-col-item title="Saldo" text="{{number_format($saldoSimpanan)}}" icon="fas fa-2x fa-wallet text-orange" size=3 />
                        <x-adminlte-profile-col-item title="JIMPay" text="{{number_format($saldoJimpay)}}" icon="fas fa-2x fa-qrcode text-orange" size=3 />
                    </x-adminlte-profile-widget>
                    @else
                    <x-adminlte-profile-widget class="elevation-4" name="{{ $user->first_name }}" desc="{{ $user->member_id }}" img="{{ asset('uploads/images/avatars/$user->avatar') }}" cover="https://picsum.photos/id/541/550/200" header-class="text-white text-right" footer-class='bg-gradient-dark'>
                        <x-adminlte-profile-row-item title="{{ $user->getRoleNames()->toArray() !== [] ? $user->getRoleNames()[0] : '-' }} - {{$user->date}}" class="text-center border-bottom border-secondary" />
                        <x-adminlte-profile-col-item title="Setoran" text="{{number_format($totalSetoran)}}" icon="fas fa-2x fa-arrow-down text-orange" size=3 />
                        <x-adminlte-profile-col-item title="Penarikan" text="{{number_format($totalPenarikan)}}" icon="fas fa-2x fa-arrow-up text-orange" size=3 />
                        <x-adminlte-profile-col-item title="Saldo" text="{{number_format($saldoSimpanan)}}" icon="fas fa-2x fa-wallet text-orange" size=3 />
                        <x-adminlte-profile-col-item title="JIMPay" text="{{number_format($saldoJimpay)}}" icon="fas fa-2x fa-qrcode text-orange" size=3 />
                    </x-adminlte-profile-widget>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Setoran</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Penarikan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Topup</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Transaksi</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-center">Setoran Simpanan</h5>
                                                <form action="{{ route('users.storeSimpanan') }}" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <x-adminlte-input name="anggota_id" type="hidden" value="{{$user->id}}" required></x-adminlte-input>

                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tgl-transaksi">{{ __('Tgl Transaksi') }}</label>
                                                                <input type="datetime-local" name="tgl_transaksi" id="tgl-transaksi" class="form-control @error('tgl_transaksi') is-invalid @enderror" value="{{now()}}" placeholder="{{ __('Tgl Transaksi') }}" required />
                                                                @error('tgl_transaksi')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="jenis-id">{{ __('Jenis Simpanan') }}</label>
                                                                <select class="form-control @error('jenis_id') is-invalid @enderror" name="jenis_id" id="jenis-id" required>
                                                                    <option value="" selected disabled>-- {{ __('Pilih Jenis Simpanan') }} --</option>

                                                                    @foreach ($savingTypes as $savingType)
                                                                    <option value="{{ $savingType->id }}" {{ isset($deposit) && $deposit->jenis_id == $savingType->id ? 'selected' : (old('jenis_id') == $savingType->id ? 'selected' : '') }}>
                                                                        {{ $savingType->jns_simpan }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('jenis_id')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="jumlah">{{ __('Jumlah') }}</label>
                                                                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="{{ __('Jumlah') }}" required />
                                                                @error('jumlah')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="keterangan">{{ __('Keterangan') }}</label>
                                                                <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="{{ __('Keterangan') }}" />
                                                                @error('keterangan')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="kas-id">{{ __('Untuk Kas') }}</label>
                                                                <select class="form-control @error('kas_id') is-invalid @enderror" name="kas_id" id="kas-id" required>
                                                                    <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>

                                                                    @foreach ($cashTypes as $cashType)
                                                                    <option value="{{ $cashType->id }}" {{ isset($deposit) && $deposit->kas_id == $cashType->id ? 'selected' : (old('kas_id') == $cashType->id ? 'selected' : '') }}>
                                                                        {{ $cashType->nama }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('kas_id')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                @php
                                                $heads = ['Kode Transaksi','Tanggal Transaksi','Jenis Simpanan','Jumlah','Keterangan'];
                                                @endphp
                                                <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$configSetoran" striped hoverable bordered with-buttons />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-center">Penarikan Simpanan</h5>
                                                <form action="{{ route('users.storePenarikan') }}" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <x-adminlte-input name="anggota_id" type="hidden" value="{{$user->id}}" required></x-adminlte-input>

                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tgl-transaksi">{{ __('Tgl Transaksi') }}</label>
                                                                <input type="datetime-local" name="tgl_transaksi" id="tgl-transaksi" class="form-control @error('tgl_transaksi') is-invalid @enderror" value="{{now()}}" placeholder="{{ __('Tgl Transaksi') }}" required />
                                                                @error('tgl_transaksi')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="jenis-id">{{ __('Jenis Simpanan') }}</label>
                                                                <select class="form-control @error('jenis_id') is-invalid @enderror" name="jenis_id" id="jenis-id" required>
                                                                    <option value="" selected disabled>-- {{ __('Pilih Jenis Simpanan') }} --</option>

                                                                    @foreach ($savingTypes as $savingType)
                                                                    <option value="{{ $savingType->id }}" {{ isset($deposit) && $deposit->jenis_id == $savingType->id ? 'selected' : (old('jenis_id') == $savingType->id ? 'selected' : '') }}>
                                                                        {{ $savingType->jns_simpan }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('jenis_id')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="jumlah">{{ __('Jumlah') }}</label>
                                                                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="{{ __('Jumlah') }}" required />
                                                                @error('jumlah')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="keterangan">{{ __('Keterangan') }}</label>
                                                                <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="{{ __('Keterangan') }}" />
                                                                @error('keterangan')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="kas-id">{{ __('Dari Kas') }}</label>
                                                                <select class="form-control @error('kas_id') is-invalid @enderror" name="kas_id" id="kas-id" required>
                                                                    <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>

                                                                    @foreach ($cashTypes as $cashType)
                                                                    <option value="{{ $cashType->id }}" {{ isset($deposit) && $deposit->kas_id == $cashType->id ? 'selected' : (old('kas_id') == $cashType->id ? 'selected' : '') }}>
                                                                        {{ $cashType->nama }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('kas_id')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                @php
                                                $heads = [
                                                ['label' => 'Kode Transaksi', 'classes' => 'text-center'],
                                                ['label' => 'Tanggal Transaksi', 'classes' => 'text-center'],
                                                ['label' => 'Jenis Simpanan', 'classes' => 'text-center'],
                                                ['label' => 'Jumlah', 'classes' => 'text-center'],
                                                ['label' => 'Keterangan', 'classes' => 'text-center']
                                                ];
                                                @endphp
                                                <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$configPenarikan" striped hoverable bordered with-buttons />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-center">Topup JIMPay</h5>
                                                <form action="{{ route('users.storeTopup') }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <x-adminlte-input name="user_id" type="hidden" value="{{$user->id}}" required>

                                                    </x-adminlte-input>
                                                    <x-adminlte-input name="amount" label="Nominal" type="number" placeholder="Nominal" label-class="text-lightblue">
                                                        <x-slot name="prependSlot">
                                                            <div class="input-group-text">
                                                                <i class="far fa-money-bill-alt text-lightblue"></i>
                                                            </div>
                                                        </x-slot>
                                                    </x-adminlte-input>
                                                    <x-adminlte-select name="note" label="Keterangan" label-class="text-lightblue">
                                                        <x-slot name="prependSlot">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                                                            </div>
                                                        </x-slot>
                                                        <option value="Topup Cash">Topup Cash</option>
                                                        <option value="Voucher Bulanan">Voucher Bulanan</option>
                                                    </x-adminlte-select>
                                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                @php
                                                $heads = ['Kode Transaksi','Tanggal Transaksi','Jumlah','Keterangan'];
                                                @endphp
                                                <x-adminlte-datatable id="table3" :heads="$heads" head-theme="dark" :config="$configTopup" striped hoverable bordered with-buttons />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                @php
                                                $heads = ['Kode Transaksi','Tanggal Transaksi','Jumlah','Keterangan'];
                                                @endphp
                                                <x-adminlte-datatable id="table4" :heads="$heads" head-theme="dark" :config="$configTransaksi" striped hoverable bordered with-buttons />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection