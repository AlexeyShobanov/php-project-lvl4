<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::select($name, $dataList, $value, ['placeholder' => $placeholder, $attributes->merge(['class' => ($errors->has($name) ? 'is-invalid' : '')])]) }}
     @error('status_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
