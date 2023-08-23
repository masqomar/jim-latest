<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kd-aktiva">{{ __('Kd Aktiva') }}</label>
            <input type="text" name="kd_aktiva" id="kd-aktiva" class="form-control @error('kd_aktiva') is-invalid @enderror" value="{{ isset($accountType) ? $accountType->kd_aktiva : old('kd_aktiva') }}" placeholder="{{ __('Kd Aktiva') }}" required />
            @error('kd_aktiva')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jns-tran">{{ __('Jns Trans') }}</label>
            <input type="text" name="jns_trans" id="jns-tran" class="form-control @error('jns_trans') is-invalid @enderror" value="{{ isset($accountType) ? $accountType->jns_trans : old('jns_trans') }}" placeholder="{{ __('Jns Trans') }}" required />
            @error('jns_trans')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="akun">{{ __('Akun') }}</label>
            <select class="form-select @error('akun') is-invalid @enderror" name="akun" id="akun" class="form-control">
                <option value="" selected disabled>-- {{ __('Select akun') }} --</option>
                <option value="Aktiva" {{ isset($accountType) && $accountType->akun == 'Aktiva' ? 'selected' : (old('akun') == 'Aktiva' ? 'selected' : '') }}>Aktiva</option>
		<option value="Pasiva" {{ isset($accountType) && $accountType->akun == 'Pasiva' ? 'selected' : (old('akun') == 'Pasiva' ? 'selected' : '') }}>Pasiva</option>			
            </select>
            @error('akun')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="laba-rugi">{{ __('Laba Rugi') }}</label>
            <select class="form-select @error('laba_rugi') is-invalid @enderror" name="laba_rugi" id="laba-rugi" class="form-control">
                <option value="" selected disabled>-- {{ __('Select laba rugi') }} --</option>
                <option value="PENDAPATAN" {{ isset($accountType) && $accountType->laba_rugi == 'PENDAPATAN' ? 'selected' : (old('laba_rugi') == 'PENDAPATAN' ? 'selected' : '') }}>PENDAPATAN</option>
		<option value="BIAYA" {{ isset($accountType) && $accountType->laba_rugi == 'BIAYA' ? 'selected' : (old('laba_rugi') == 'BIAYA' ? 'selected' : '') }}>BIAYA</option>			
            </select>
            @error('laba_rugi')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="pemasukan">{{ __('Pemasukan') }}</label>
            <select class="form-select @error('pemasukan') is-invalid @enderror" name="pemasukan" id="pemasukan" class="form-control">
                <option value="" selected disabled>-- {{ __('Select pemasukan') }} --</option>
                <option value="Y" {{ isset($accountType) && $accountType->pemasukan == 'Y' ? 'selected' : (old('pemasukan') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="N" {{ isset($accountType) && $accountType->pemasukan == 'N' ? 'selected' : (old('pemasukan') == 'N' ? 'selected' : '') }}>N</option>			
            </select>
            @error('pemasukan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="pengeluaran">{{ __('Pengeluaran') }}</label>
            <select class="form-select @error('pengeluaran') is-invalid @enderror" name="pengeluaran" id="pengeluaran" class="form-control">
                <option value="" selected disabled>-- {{ __('Select pengeluaran') }} --</option>
                <option value="Y" {{ isset($accountType) && $accountType->pengeluaran == 'Y' ? 'selected' : (old('pengeluaran') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="N" {{ isset($accountType) && $accountType->pengeluaran == 'N' ? 'selected' : (old('pengeluaran') == 'N' ? 'selected' : '') }}>N</option>			
            </select>
            @error('pengeluaran')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="aktif">{{ __('Aktif') }}</label>
            <select class="form-select @error('aktif') is-invalid @enderror" name="aktif" id="aktif" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select aktif') }} --</option>
                <option value="Y" {{ isset($accountType) && $accountType->aktif == 'Y' ? 'selected' : (old('aktif') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="N" {{ isset($accountType) && $accountType->aktif == 'N' ? 'selected' : (old('aktif') == 'N' ? 'selected' : '') }}>N</option>			
            </select>
            @error('aktif')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>