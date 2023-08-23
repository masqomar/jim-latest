<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="jns-simpan">{{ __('Jns Simpan') }}</label>
            <input type="text" name="jns_simpan" id="jns-simpan" class="form-control @error('jns_simpan') is-invalid @enderror" value="{{ isset($savingType) ? $savingType->jns_simpan : old('jns_simpan') }}" placeholder="{{ __('Jns Simpan') }}" required />
            @error('jns_simpan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jumlah">{{ __('Jumlah') }}</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ isset($savingType) ? $savingType->jumlah : old('jumlah') }}" placeholder="{{ __('Jumlah') }}" required />
            @error('jumlah')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tampil">{{ __('Tampil') }}</label>
            <select class="form-select @error('tampil') is-invalid @enderror" name="tampil" id="tampil" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select tampil') }} --</option>
                <option value="Y" {{ isset($savingType) && $savingType->tampil == 'Y' ? 'selected' : (old('tampil') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($savingType) && $savingType->tampil == 'T' ? 'selected' : (old('tampil') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tampil')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>