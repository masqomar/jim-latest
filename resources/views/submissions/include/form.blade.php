<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-ajuan">{{ __('No Ajuan') }}</label>
            <input type="number" name="no_ajuan" id="no-ajuan" class="form-control @error('no_ajuan') is-invalid @enderror" value="{{ isset($submission) ? $submission->no_ajuan : old('no_ajuan') }}" placeholder="{{ __('No Ajuan') }}" required />
            @error('no_ajuan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ajuan-id">{{ __('Ajuan Id') }}</label>
            <input type="text" name="ajuan_id" id="ajuan-id" class="form-control @error('ajuan_id') is-invalid @enderror" value="{{ isset($submission) ? $submission->ajuan_id : old('ajuan_id') }}" placeholder="{{ __('Ajuan Id') }}" required />
            @error('ajuan_id')
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
                            <option value="{{ $user->id }}" {{ isset($submission) && $submission->anggota_id == $user->id ? 'selected' : (old('anggota_id') == $user->id ? 'selected' : '') }}>
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
            <label for="tgl-input">{{ __('Tgl Input') }}</label>
            <input type="datetime-local" name="tgl_input" id="tgl-input" class="form-control @error('tgl_input') is-invalid @enderror" value="{{ isset($submission) && $submission->tgl_input ? $submission->tgl_input->format('Y-m-d\TH:i') : old('tgl_input') }}" placeholder="{{ __('Tgl Input') }}" required />
            @error('tgl_input')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jeni">{{ __('Jenis') }}</label>
            <input type="text" name="jenis" id="jeni" class="form-control @error('jenis') is-invalid @enderror" value="{{ isset($submission) ? $submission->jenis : old('jenis') }}" placeholder="{{ __('Jenis') }}" required />
            @error('jenis')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nominal">{{ __('Nominal') }}</label>
            <input type="number" name="nominal" id="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ isset($submission) ? $submission->nominal : old('nominal') }}" placeholder="{{ __('Nominal') }}" required />
            @error('nominal')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lama-ag">{{ __('Lama Ags') }}</label>
            <input type="number" name="lama_ags" id="lama-ag" class="form-control @error('lama_ags') is-invalid @enderror" value="{{ isset($submission) ? $submission->lama_ags : old('lama_ags') }}" placeholder="{{ __('Lama Ags') }}" required />
            @error('lama_ags')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="keterangan">{{ __('Keterangan') }}</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ isset($submission) ? $submission->keterangan : old('keterangan') }}" placeholder="{{ __('Keterangan') }}" required />
            @error('keterangan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">{{ __('Status') }}</label>
            <input type="number" name="status" id="status" class="form-control @error('status') is-invalid @enderror" value="{{ isset($submission) ? $submission->status : old('status') }}" placeholder="{{ __('Status') }}" required />
            @error('status')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="alasan">{{ __('Alasan') }}</label>
            <input type="text" name="alasan" id="alasan" class="form-control @error('alasan') is-invalid @enderror" value="{{ isset($submission) ? $submission->alasan : old('alasan') }}" placeholder="{{ __('Alasan') }}" />
            @error('alasan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl-cair">{{ __('Tgl Cair') }}</label>
            <input type="date" name="tgl_cair" id="tgl-cair" class="form-control @error('tgl_cair') is-invalid @enderror" value="{{ isset($submission) && $submission->tgl_cair ? $submission->tgl_cair->format('Y-m-d') : old('tgl_cair') }}" placeholder="{{ __('Tgl Cair') }}" />
            @error('tgl_cair')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>