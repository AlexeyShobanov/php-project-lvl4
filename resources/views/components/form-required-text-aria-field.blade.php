<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::textarea($name, $value, [$attributes->merge(['class' => ($errors->has($name) ? 'is-invalid' : '')])]) }}
    @error('content')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>