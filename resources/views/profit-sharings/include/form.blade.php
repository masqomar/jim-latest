<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="opsi-key">{{ __('Opsi Key') }}</label>
            <input type="text" name="opsi_key" id="opsi-key" class="form-control @error('opsi_key') is-invalid @enderror" value="{{ isset($profitSharing) ? $profitSharing->opsi_key : old('opsi_key') }}" placeholder="{{ __('Opsi Key') }}" required />
            @error('opsi_key')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="opsi-val">{{ __('Opsi Val') }}</label>
            <input type="text" name="opsi_val" id="opsi-val" class="form-control @error('opsi_val') is-invalid @enderror" value="{{ isset($profitSharing) ? $profitSharing->opsi_val : old('opsi_val') }}" placeholder="{{ __('Opsi Val') }}" required />
            @error('opsi_val')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>