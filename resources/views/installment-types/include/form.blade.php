<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="ket">{{ __('Ket') }}</label>
            <input type="number" name="ket" id="ket" class="form-control @error('ket') is-invalid @enderror" value="{{ isset($installmentType) ? $installmentType->ket : old('ket') }}" placeholder="{{ __('Ket') }}" required />
            @error('ket')
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
                <option value="Y" {{ isset($installmentType) && $installmentType->aktif == 'Y' ? 'selected' : (old('aktif') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($installmentType) && $installmentType->aktif == 'T' ? 'selected' : (old('aktif') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('aktif')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>