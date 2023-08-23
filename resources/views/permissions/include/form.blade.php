<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($permission) ? $permission->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="guard_name">{{ __('Guard') }}</label>
            <input type="text" name="guard_name" id="guard_name" class="form-control @error('guard_name') is-invalid @enderror" value="web" placeholder="{{ __('guard_name') }}" required />
            @error('guard_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>