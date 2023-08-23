<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nm-barang">{{ __('Nm Barang') }}</label>
            <input type="text" name="nm_barang" id="nm-barang" class="form-control @error('nm_barang') is-invalid @enderror" value="{{ isset($kopProduct) ? $kopProduct->nm_barang : old('nm_barang') }}" placeholder="{{ __('Nm Barang') }}" required />
            @error('nm_barang')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="type">{{ __('Type') }}</label>
            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ (isset($kopProduct) ? $kopProduct->type : old('type')) ? old('type') : '-' }}" placeholder="{{ __('Type') }}" />
            @error('type')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="merk">{{ __('Merk') }}</label>
            <input type="text" name="merk" id="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ (isset($kopProduct) ? $kopProduct->merk : old('merk')) ? old('merk') : '-' }}" placeholder="{{ __('Merk') }}" />
            @error('merk')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="harga">{{ __('Harga') }}</label>
            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ isset($kopProduct) ? $kopProduct->harga : old('harga') }}" placeholder="{{ __('Harga') }}" required />
            @error('harga')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jml-brg">{{ __('Jml Brg') }}</label>
            <input type="number" name="jml_brg" id="jml-brg" class="form-control @error('jml_brg') is-invalid @enderror" value="{{ isset($kopProduct) ? $kopProduct->jml_brg : old('jml_brg') }}" placeholder="{{ __('Jml Brg') }}" required />
            @error('jml_brg')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>