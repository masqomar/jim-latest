<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-bayar">{{ __('Tgl Bayar') }}</label>
            <input type="datetime-local" name="tgl_bayar" id="tgl-bayar" class="form-control @error('tgl_bayar') is-invalid @enderror" value="{{ isset($loanDetail) && $loanDetail->tgl_bayar ? $loanDetail->tgl_bayar->format('Y-m-d\TH:i') : old('tgl_bayar') }}" placeholder="{{ __('Tgl Bayar') }}" required />
            @error('tgl_bayar')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="pinjam-id">{{ __('Loan') }}</label>
            <select class="form-select @error('pinjam_id') is-invalid @enderror" name="pinjam_id" id="pinjam-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select loan') }} --</option>
                
                        @foreach ($loans as $loan)
                            <option value="{{ $loan->id }}" {{ isset($loanDetail) && $loanDetail->pinjam_id == $loan->id ? 'selected' : (old('pinjam_id') == $loan->id ? 'selected' : '') }}>
                                {{ $loan->tgl_pinjam }}
                            </option>
                        @endforeach
            </select>
            @error('pinjam_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="angsuran-ke">{{ __('Angsuran Ke') }}</label>
            <input type="number" name="angsuran_ke" id="angsuran-ke" class="form-control @error('angsuran_ke') is-invalid @enderror" value="{{ isset($loanDetail) ? $loanDetail->angsuran_ke : old('angsuran_ke') }}" placeholder="{{ __('Angsuran Ke') }}" required />
            @error('angsuran_ke')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jumlah-bayar">{{ __('Jumlah Bayar') }}</label>
            <input type="number" name="jumlah_bayar" id="jumlah-bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ isset($loanDetail) ? $loanDetail->jumlah_bayar : old('jumlah_bayar') }}" placeholder="{{ __('Jumlah Bayar') }}" required />
            @error('jumlah_bayar')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="denda-rp">{{ __('Denda Rp') }}</label>
            <input type="number" name="denda_rp" id="denda-rp" class="form-control @error('denda_rp') is-invalid @enderror" value="{{ isset($loanDetail) ? $loanDetail->denda_rp : old('denda_rp') }}" placeholder="{{ __('Denda Rp') }}" />
            @error('denda_rp')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="terlambat">{{ __('Terlambat') }}</label>
            <input type="number" name="terlambat" id="terlambat" class="form-control @error('terlambat') is-invalid @enderror" value="{{ isset($loanDetail) ? $loanDetail->terlambat : old('terlambat') }}" placeholder="{{ __('Terlambat') }}" />
            @error('terlambat')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ket-bayar">{{ __('Ket Bayar') }}</label>
            <select class="form-select @error('ket_bayar') is-invalid @enderror" name="ket_bayar" id="ket-bayar" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select ket bayar') }} --</option>
                <option value="Angsuran" {{ isset($loanDetail) && $loanDetail->ket_bayar == 'Angsuran' ? 'selected' : (old('ket_bayar') == 'Angsuran' ? 'selected' : '') }}>Angsuran</option>
		<option value="Pelunasan" {{ isset($loanDetail) && $loanDetail->ket_bayar == 'Pelunasan' ? 'selected' : (old('ket_bayar') == 'Pelunasan' ? 'selected' : '') }}>Pelunasan</option>
		<option value="Bayar Denda" {{ isset($loanDetail) && $loanDetail->ket_bayar == 'Bayar Denda' ? 'selected' : (old('ket_bayar') == 'Bayar Denda' ? 'selected' : '') }}>Bayar Denda</option>			
            </select>
            @error('ket_bayar')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="dk">{{ __('Dk') }}</label>
            <select class="form-select @error('dk') is-invalid @enderror" name="dk" id="dk" class="form-control">
                <option value="" selected disabled>-- {{ __('Select dk') }} --</option>
                <option value="D" {{ isset($loanDetail) && $loanDetail->dk == 'D' ? 'selected' : (old('dk') == 'D' ? 'selected' : '') }}>D</option>
		<option value="K" {{ isset($loanDetail) && $loanDetail->dk == 'K' ? 'selected' : (old('dk') == 'K' ? 'selected' : '') }}>K</option>			
            </select>
            @error('dk')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kas-id">{{ __('Jenis Kas') }}</label>
            <select class="form-select @error('kas_id') is-invalid @enderror" name="kas_id" id="kas-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>
                
                        @foreach ($cashTypes as $cashType)
                            <option value="{{ $cashType->id }}" {{ isset($loanDetail) && $loanDetail->kas_id == $cashType->id ? 'selected' : (old('kas_id') == $cashType->id ? 'selected' : '') }}>
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
    <div class="col-md-6">
        <div class="form-group">
            <label for="jns-tran">{{ __('Account Type') }}</label>
            <select class="form-select @error('jns_trans') is-invalid @enderror" name="jns_trans" id="jns-tran" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Pilih Akun') }} --</option>
                
                        @foreach ($accountTypes as $accountType)
                            <option value="{{ $accountType->id }}" {{ isset($loanDetail) && $loanDetail->jns_trans == $accountType->id ? 'selected' : (old('jns_trans') == $accountType->id ? 'selected' : '') }}>
                                {{ $accountType->kd_aktiva }}
                            </option>
                        @endforeach
            </select>
            @error('jns_trans')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>