<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::select($name, $dataList, $value, ['placeholder' => $placeholder, $attributes, 'multiple' => 'multiple', 'style' => 'height: 10em;']) }}
</div>