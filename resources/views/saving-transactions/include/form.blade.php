<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-transaksi">{{ __('Tgl Transaksi') }}</label>
            <input type="datetime-local" name="tgl_transaksi" id="tgl-transaksi" class="form-control @error('tgl_transaksi') is-invalid @enderror" value="{{ isset($savingTransaction) && $savingTransaction->tgl_transaksi ? $savingTransaction->tgl_transaksi->format('Y-m-d\TH:i') : old('tgl_transaksi') }}" placeholder="{{ __('Tgl Transaksi') }}" required />
            @error('tgl_transaksi')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="anggota-id">{{ __('User') }}</label>
            <select class="form-select @error('anggota_id') is-invalid @enderror" name="anggota_id" id="anggota-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($savingTransaction) && $savingTransaction->anggota_id == $user->id ? 'selected' : (old('anggota_id') == $user->id ? 'selected' : '') }}>
                                {{ $user->first_name }}
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
            <label for="jenis-id">{{ __('Saving Type') }}</label>
            <select class="form-select @error('jenis_id') is-invalid @enderror" name="jenis_id" id="jenis-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select saving type') }} --</option>
                
                        @foreach ($savingTypes as $savingType)
                            <option value="{{ $savingType->id }}" {{ isset($savingTransaction) && $savingTransaction->jenis_id == $savingType->id ? 'selected' : (old('jenis_id') == $savingType->id ? 'selected' : '') }}>
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
            <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ isset($savingTransaction) ? $savingTransaction->jumlah : old('jumlah') }}" placeholder="{{ __('Jumlah') }}" required />
            @error('jumlah')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="akun">{{ __('Akun') }}</label>
            <select class="form-select @error('akun') is-invalid @enderror" name="akun" id="akun" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select akun') }} --</option>
                <option value="Setoran" {{ isset($savingTransaction) && $savingTransaction->akun == 'Setoran' ? 'selected' : (old('akun') == 'Setoran' ? 'selected' : '') }}>Setoran</option>
		<option value="Penarikan" {{ isset($savingTransaction) && $savingTransaction->akun == 'Penarikan' ? 'selected' : (old('akun') == 'Penarikan' ? 'selected' : '') }}>Penarikan</option>			
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
            <label for="dk">{{ __('Dk') }}</label>
            <select class="form-select @error('dk') is-invalid @enderror" name="dk" id="dk" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select dk') }} --</option>
                <option value="D" {{ isset($savingTransaction) && $savingTransaction->dk == 'D' ? 'selected' : (old('dk') == 'D' ? 'selected' : '') }}>D</option>
		<option value="K" {{ isset($savingTransaction) && $savingTransaction->dk == 'K' ? 'selected' : (old('dk') == 'K' ? 'selected' : '') }}>K</option>			
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
            <label for="kas-id">{{ __('Cash Type') }}</label>
            <select class="form-select @error('kas_id') is-invalid @enderror" name="kas_id" id="kas-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>
                
                        @foreach ($cashTypes as $cashType)
                            <option value="{{ $cashType->id }}" {{ isset($savingTransaction) && $savingTransaction->kas_id == $cashType->id ? 'selected' : (old('kas_id') == $cashType->id ? 'selected' : '') }}>
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