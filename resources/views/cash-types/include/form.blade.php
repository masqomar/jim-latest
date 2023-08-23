<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">{{ __('Nama') }}</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ isset($cashType) ? $cashType->nama : old('nama') }}" placeholder="{{ __('Nama') }}" required />
            @error('nama')
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
                <option value="Y" {{ isset($cashType) && $cashType->aktif == 'Y' ? 'selected' : (old('aktif') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->aktif == 'T' ? 'selected' : (old('aktif') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('aktif')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tmpl-simpan">{{ __('Tmpl Simpan') }}</label>
            <select class="form-select @error('tmpl_simpan') is-invalid @enderror" name="tmpl_simpan" id="tmpl-simpan" class="form-control">
                <option value="" selected disabled>-- {{ __('Select tmpl simpan') }} --</option>
                <option value="Y" {{ isset($cashType) && $cashType->tmpl_simpan == 'Y' ? 'selected' : (old('tmpl_simpan') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->tmpl_simpan == 'T' ? 'selected' : (old('tmpl_simpan') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tmpl_simpan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tmpl-penarikan">{{ __('Tmpl Penarikan') }}</label>
            <select class="form-select @error('tmpl_penarikan') is-invalid @enderror" name="tmpl_penarikan" id="tmpl-penarikan" class="form-control">
                <option value="" selected disabled>-- {{ __('Select tmpl penarikan') }} --</option>
                <option value="Y" {{ isset($cashType) && $cashType->tmpl_penarikan == 'Y' ? 'selected' : (old('tmpl_penarikan') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->tmpl_penarikan == 'T' ? 'selected' : (old('tmpl_penarikan') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tmpl_penarikan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tmpl-pinjaman">{{ __('Tmpl Pinjaman') }}</label>
            <select class="form-select @error('tmpl_pinjaman') is-invalid @enderror" name="tmpl_pinjaman" id="tmpl-pinjaman" class="form-control">
                <option value="" selected disabled>-- {{ __('Select tmpl pinjaman') }} --</option>
                <option value="Y" {{ isset($cashType) && $cashType->tmpl_pinjaman == 'Y' ? 'selected' : (old('tmpl_pinjaman') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->tmpl_pinjaman == 'T' ? 'selected' : (old('tmpl_pinjaman') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tmpl_pinjaman')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tmpl-bayar">{{ __('Tmpl Bayar') }}</label>
            <select class="form-select @error('tmpl_bayar') is-invalid @enderror" name="tmpl_bayar" id="tmpl-bayar" class="form-control">
                <option value="" selected disabled>-- {{ __('Select tmpl bayar') }} --</option>
                <option value="Y" {{ isset($cashType) && $cashType->tmpl_bayar == 'Y' ? 'selected' : (old('tmpl_bayar') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->tmpl_bayar == 'T' ? 'selected' : (old('tmpl_bayar') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tmpl_bayar')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tmpl-pemasukan">{{ __('Tmpl Pemasukan') }}</label>
            <select class="form-select @error('tmpl_pemasukan') is-invalid @enderror" name="tmpl_pemasukan" id="tmpl-pemasukan" class="form-control">
                <option value="" selected disabled>-- {{ __('Select tmpl pemasukan') }} --</option>
                <option value="Y" {{ isset($cashType) && $cashType->tmpl_pemasukan == 'Y' ? 'selected' : (old('tmpl_pemasukan') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->tmpl_pemasukan == 'T' ? 'selected' : (old('tmpl_pemasukan') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tmpl_pemasukan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tmpl-pengeluaran">{{ __('Tmpl Pengeluaran') }}</label>
            <select class="form-select @error('tmpl_pengeluaran') is-invalid @enderror" name="tmpl_pengeluaran" id="tmpl-pengeluaran" class="form-control">
                <option value="" selected disabled>-- {{ __('Select tmpl pengeluaran') }} --</option>
                <option value="Y" {{ isset($cashType) && $cashType->tmpl_pengeluaran == 'Y' ? 'selected' : (old('tmpl_pengeluaran') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->tmpl_pengeluaran == 'T' ? 'selected' : (old('tmpl_pengeluaran') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tmpl_pengeluaran')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tmpl-transfer">{{ __('Tmpl Transfer') }}</label>
            <select class="form-select @error('tmpl_transfer') is-invalid @enderror" name="tmpl_transfer" id="tmpl-transfer" class="form-control">
                <option value="" selected disabled>-- {{ __('Select tmpl transfer') }} --</option>
                <option value="Y" {{ isset($cashType) && $cashType->tmpl_transfer == 'Y' ? 'selected' : (old('tmpl_transfer') == 'Y' ? 'selected' : '') }}>Y</option>
		<option value="T" {{ isset($cashType) && $cashType->tmpl_transfer == 'T' ? 'selected' : (old('tmpl_transfer') == 'T' ? 'selected' : '') }}>T</option>			
            </select>
            @error('tmpl_transfer')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>