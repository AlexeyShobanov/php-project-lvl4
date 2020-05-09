@extends('layouts.app')

@section('content')
    <div class="
    jumbotron-fluid bg-light">
        <div class="container py-4">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                    <h1  class="mb-5">{{__('messages.editLabel')}}</h1>
                    {{ Form::model($label, ['url' => route('labels.update', $label->id), 'class' => 'justify-content-center', 'method' => 'PATCH']) }}
                    <div class="form-group">
                        <label for="name">{{__('messages.name')}}</label>
                        {{ Form::text('name', $label->name, ['class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : '')]) }}
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('messages.description')}}</label>
                        {{ Form::textarea('description', $label->description, ['class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        <label for="color_id">{{__('messages.color')}}</label>
                        {{ Form::select('color_id', $colors, $label->color_id, ['placeholder' => __('messages.color'), 'class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit(__('messages.update'), ['class' => 'btn btn-lg btn-primary px-5 text-uppercase']) }}
                    </div> 
                    {{ Form::close() }}
                </div>
        </div>
    </div>
@endsection