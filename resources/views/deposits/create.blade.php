@extends('adminlte::page')
@section('plugins.Select2', true)
@section('title', 'Setoran Simpanan')

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
                        <form action="{{ route('deposits.store') }}" method="POST">
                            @csrf
                            @method('POST')

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
                                        <label for="anggota-id">{{ __('Anggota') }}</label>
                                        <x-adminlte-select2 id="anggota_id" name="anggota_id[]" label-class="text-danger" data-placeholder="Maksimal 10 orang ya...untuk 1x input" multiple required>
                                            @foreach ($users as $user)
                                            <option value="{!! $user['id'] !!}">
                                                {{ $user->member_id }} || {{ $user->first_name }}
                                            </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                        @error('anggota_id')
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
                                        <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ isset($deposit) ? $deposit->jumlah : old('jumlah') }}" placeholder="{{ __('Jumlah') }}" required />
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
                                        <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ isset($deposit) ? $deposit->keterangan : old('keterangan') }}" placeholder="{{ __('Keterangan') }}" />
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


                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
