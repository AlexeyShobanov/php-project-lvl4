<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::textarea($name, $value, [$attributes, 'style' => 'height: 10em;']) }}
</div>
