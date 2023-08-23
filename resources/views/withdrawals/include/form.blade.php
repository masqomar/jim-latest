<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-transaksi">{{ __('Tgl Transaksi') }}</label>
            <input type="datetime-local" name="tgl_transaksi" id="tgl-transaksi" class="form-control @error('tgl_transaksi') is-invalid @enderror" value="{{ isset($withdrawal) && $withdrawal->tgl_transaksi ? $withdrawal->tgl_transaksi->format('Y-m-d\TH:i') : old('tgl_transaksi') }}" placeholder="{{ __('Tgl Transaksi') }}" required />
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
            <select class="form-control @error('anggota_id') is-invalid @enderror" name="anggota_id" id="anggota-id" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($withdrawal) && $withdrawal->anggota_id == $user->id ? 'selected' : (old('anggota_id') == $user->id ? 'selected' : '') }}>
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
            <label for="jenis-id">{{ __('Jenis Simpanan') }}</label>
            <select class="form-control @error('jenis_id') is-invalid @enderror" name="jenis_id" id="jenis-id" required>
                <option value="" selected disabled>-- {{ __('Select saving type') }} --</option>
                
                        @foreach ($savingTypes as $savingType)
                            <option value="{{ $savingType->id }}" {{ isset($withdrawal) && $withdrawal->jenis_id == $savingType->id ? 'selected' : (old('jenis_id') == $savingType->id ? 'selected' : '') }}>
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
            <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ isset($withdrawal) ? $withdrawal->jumlah : old('jumlah') }}" placeholder="{{ __('Jumlah') }}" required />
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
            <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ isset($withdrawal) ? $withdrawal->keterangan : old('keterangan') }}" placeholder="{{ __('Keterangan') }}" />
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
                            <option value="{{ $cashType->id }}" {{ isset($withdrawal) && $withdrawal->kas_id == $cashType->id ? 'selected' : (old('kas_id') == $cashType->id ? 'selected' : '') }}>
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

