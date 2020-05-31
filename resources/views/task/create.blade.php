@extends('layouts.app')

@section('content')

    <div class="jumbotron-fluid bg-light">
        <div class="container py-4">
            <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
            <h1  class="mb-5">{{__('views.task.create.header')}}</h1>
                {{ Form::model($task, ['url' => route('tasks.store'), 'class' => 'justify-content-center']) }}
                    <x-form.required-text-field label="{{ __('views.task.create.name') }}" name="name" value="{{ $task->name }}" message="{{ $message ?? '' }}" class="form-control form-control-lg"/>
                    <x-form.drop-down-multi-list label="{{ __('views.task.create.label') }}" name="labels_id[]" value="{{ $task->label_id }}" placeholder="{{ __('views.task.create.chooseLabel') }}" :dataList="$labels" class="form-control form-control-lg"/>
                    <x-form.text-aria-field label="{{ __('views.task.create.description') }}" name="description" value="{{ $task->description }}" class="form-control form-control-lg"/>
                    <x-form.required-drop-down-list label="{{ __('views.task.create.status') }}" name="status_id" value="{{ $defaultStatus }}" placeholder="{{ __('views.task.create.chooseStatus') }}" message="{{ $message ?? '' }}" :dataList="$statuses" class="form-control form-control-lg"/>
                    <x-form.drop-down-list label="{{ __('views.task.create.assignee') }}" name="assigned_to_id" value="{{ $task->assigned_to_id }}" placeholder="{{ __('views.task.create.chooseAssignee') }}" :dataList="$users" class="form-control form-control-lg"/>
                    <x-form.submit-button name="{{ __('views.task.create.create') }}" class="btn btn-primary px-5 text-uppercase"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
