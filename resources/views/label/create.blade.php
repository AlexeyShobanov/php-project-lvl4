@extends('layouts.app')

@section('content')
    <div class="jumbotron-fluid bg-light">
        <div class="container py-4">
            <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                <h1  class="mb-5">{{__('views.label.create.header')}}</h1>
                {{ Form::model($label, ['url' => route('labels.store'), 'class' => 'justify-content-center']) }}
                    <x-form-required-text-field label="{{ __('views.label.create.name') }}" name="name" value="{{ $label->name }}" message="{{ $message ?? '' }}" class="form-control form-control-lg"/>
                    <x-form-text-aria-field label="{{ __('views.label.create.description') }}" name="description" value="{{ $label->description }}" class="form-control form-control-lg"/>
                    <x-form-drop-down-list label="{{ __('views.label.create.color') }}" name="color_id" value="{{ $label->color_id }}" placeholder="{{ __('views.label.create.color') }}" :dataList="$colors" class="form-control form-control-lg"/>
                    <x-form-submit-button name="{{ __('views.label.create.create') }}" class="btn btn-primary px-5 text-uppercase"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection