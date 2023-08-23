<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-catat">{{ __('Tgl Catat') }}</label>
            <input type="datetime-local" name="tgl_catat" id="tgl-catat" class="form-control @error('tgl_catat') is-invalid @enderror" value="{{ isset($cashTransfer) && $cashTransfer->tgl_catat ? $cashTransfer->tgl_catat->format('Y-m-d\TH:i') : old('tgl_catat') }}" placeholder="{{ __('Tgl Catat') }}" required />
            @error('tgl_catat')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jumlah">{{ __('Jumlah') }}</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ isset($cashTransfer) ? $cashTransfer->jumlah : old('jumlah') }}" placeholder="{{ __('Jumlah') }}" required />
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
            <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ isset($cashTransfer) ? $cashTransfer->keterangan : old('keterangan') }}" placeholder="{{ __('Keterangan') }}" />
            @error('keterangan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="dari-kas-id">{{ __('Dari Kas') }}</label>
            <select class="form-control @error('dari_kas_id') is-invalid @enderror" name="dari_kas_id" id="dari-kas-id" >
                <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>
                
                        @foreach ($cashTypes as $cashType)
                            <option value="{{ $cashType->id }}" {{ isset($cashTransfer) && $cashTransfer->dari_kas_id == $cashType->id ? 'selected' : (old('dari_kas_id') == $cashType->id ? 'selected' : '') }}>
                                {{ $cashType->nama }}
                            </option>
                        @endforeach
            </select>
            @error('dari_kas_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="untuk-kas-id">{{ __('Untuk Kas') }}</label>
            <select class="form-control @error('untuk_kas_id') is-invalid @enderror" name="untuk_kas_id" id="untuk-kas-id" >
                <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>
                
                        @foreach ($cashTypes as $cashType)
                            <option value="{{ $cashType->id }}" {{ isset($cashTransfer) && $cashTransfer->untuk_kas_id == $cashType->id ? 'selected' : (old('untuk_kas_id') == $cashType->id ? 'selected' : '') }}>
                                {{ $cashType->nama }}
                            </option>
                        @endforeach
            </select>
            @error('untuk_kas_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>