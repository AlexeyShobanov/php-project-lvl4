<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::text($name, $value, [$attributes->merge(['class' => ($errors->has($name) ? 'is-invalid' : '')])]) }}
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>