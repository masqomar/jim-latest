@extends('adminlte::page')
@section('title', __('Pencairan Mitra'))
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
                    @if (session('error'))
                    <x-adminlte-alert theme="danger" title="Danger">
                        {{session('error')}}
                    </x-adminlte-alert>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('merchant-transactions.store') }}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl-catat">{{ __('Tgl Catat') }}</label>
                                        <input type="datetime-local" name="tgl_catat" id="tgl-catat" class="form-control @error('tgl_catat') is-invalid @enderror" value="{{ isset($merchantTransaction) && $merchantTransaction->tgl_catat ? $merchantTransaction->tgl_catat->format('Y-m-d\TH:i') : old('tgl_catat') }}" placeholder="{{ __('Tgl Catat') }}" required />
                                        @error('tgl_catat')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="anggota-id">{{ __('Anggota') }}</label>
                                        <select class="form-control @error('anggota_id') is-invalid @enderror" name="anggota_id" id="anggota-id" required>
                                            <option value="" selected disabled>-- {{ __('Pilih Mitra') }} --</option>

                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ isset($merchantTransaction) && $merchantTransaction->anggota_id == $user->id ? 'selected' : (old('anggota_id') == $user->id ? 'selected' : '') }}>
                                                {{ $user->member_id }} || {{ $user->first_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('anggota_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">{{ __('Nominal') }}</label>
                                        <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ isset($merchantTransaction) ? $merchantTransaction->amount : old('amount') }}" placeholder="{{ __('Nominal') }}" required />
                                        @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kas-id">{{ __('Ambil Dari Kas') }}</label>
                                        <select class="form-control @error('kas_id') is-invalid @enderror" name="kas_id" id="kas-id" required>
                                            <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>

                                            @foreach ($cashTypes as $cashType)
                                            <option value="{{ $cashType->id }}" {{ isset($merchantTransaction) && $merchantTransaction->kas_id == $cashType->id ? 'selected' : (old('kas_id') == $cashType->id ? 'selected' : '') }}>
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