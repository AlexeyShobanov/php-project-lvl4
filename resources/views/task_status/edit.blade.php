@extends('layouts.app')

@section('content')
    <div class="jumbotron-fluid bg-light">
        <div class="container py-4">
            <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                <h1  class="mb-5">{{__('views.task_status.edit.header')}}</h1>
                {{ Form::model($status, ['url' => route('task_statuses.update', $status->id), 'class' => 'justify-content-center', 'method' => 'PATCH']) }}
                    <x-form-required-text-field label="{{ __('views.task_status.edit.name') }}" name="name" value="{{ $status->name }}" message="{{ $message ?? '' }}" class="form-control form-control-lg"/>
                    <x-form-submit-button name="{{ __('views.task_status.edit.update') }}" class="btn btn-primary px-5 text-uppercase"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection