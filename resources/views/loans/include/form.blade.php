<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-pinjam">{{ __('Tanggal Pinjam') }}</label>
            <input type="datetime-local" name="tgl_pinjam" id="tgl-pinjam" class="form-control @error('tgl_pinjam') is-invalid @enderror" value="{{ isset($loan) && $loan->tgl_pinjam ? $loan->tgl_pinjam->format('Y-m-d\TH:i') : old('tgl_pinjam') }}" placeholder="{{ __('Tgl Pinjam') }}" required />
            @error('tgl_pinjam')
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
                <option value="" selected disabled>-- {{ __('Pilih Anggota') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($loan) && $loan->anggota_id == $user->id ? 'selected' : (old('anggota_id') == $user->id ? 'selected' : '') }}>
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
            <label for="barang-id">{{ __('Kop Product') }}</label>
            <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" id="barang-id" required>
                <option value="" selected disabled>-- {{ __('Pilih Barang') }} --</option>
                
                        @foreach ($kopProducts as $kopProduct)
                            <option value="{{ $kopProduct->id }}" {{ isset($loan) && $loan->barang_id == $kopProduct->id ? 'selected' : (old('barang_id') == $kopProduct->id ? 'selected' : '') }}>
                                {{ $kopProduct->nm_barang }} || @rupiah($kopProduct->harga)
                            </option>
                        @endforeach
            </select>
            @error('barang_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="lama-angsuran">{{ __('Lama Angsuran') }}</label>
            <select class="form-control @error('lama_angsuran') is-invalid @enderror" name="lama_angsuran" id="lama-angsuran" required>
                <option value="" selected disabled>-- {{ __('Pilih Tenor') }} --</option>
                
                        @foreach ($installmentTypes as $installmentType)
                            <option value="{{ $installmentType->ket }}" {{ isset($loan) && $loan->lama_angsuran == $installmentType->ket ? 'selected' : (old('lama_angsuran') == $installmentType->ket ? 'selected' : '') }}>
                                {{ $installmentType->ket }} Bulan
                            </option>
                        @endforeach
            </select>
            @error('lama_angsuran')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jumlah">{{ __('Jumlah') }}</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ isset($loan) ? $loan->jumlah : old('jumlah') }}" placeholder="{{ __('Jumlah') }}" required />
            @error('jumlah')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="biaya-adm">{{ __('Keuntungan Per Bulan') }}</label>
            <input type="number" name="biaya_adm" id="biaya-adm" class="form-control @error('biaya_adm') is-invalid @enderror" value="{{ isset($loan) ? $loan->biaya_adm : old('biaya_adm') }}" placeholder="{{ __('Biaya Adm') }}" required />
            @error('biaya_adm')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kas-id">{{ __('Ambil Dari Kas') }}</label>
            <select class="form-control @error('kas_id') is-invalid @enderror" name="kas_id" id="kas-id" required>
                <option value="" selected disabled>-- {{ __('Pilih Kas') }} --</option>
                
                        @foreach ($cashTypes as $cashType)
                            <option value="{{ $cashType->id }}" {{ isset($loan) && $loan->kas_id == $cashType->id ? 'selected' : (old('kas_id') == $cashType->id ? 'selected' : '') }}>
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