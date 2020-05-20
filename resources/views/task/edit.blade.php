@extends('layouts.app')

@section('content')
    <div class="jumbotron-fluid bg-light">
        <div class="container py-4">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                     <h1  class="mb-5">{{__('views.task.edit.header')}}</h1>    
                    {{ Form::model($task, ['url' => route('tasks.update', $task->id), 'class' => 'justify-content-center', 'method' => 'PATCH']) }}
                        <x-form-required-text-field label="{{ __('views.task.edit.name') }}" name="name" value="{{ $task->name }}" message="{{ $message ?? '' }}" class="form-control form-control-lg"/>
                        <x-form-drop-down-list label="{{ __('views.task.edit.label') }}" name="label_id" value="{{ $task->label_id }}" placeholder="{{ __('views.task.edit.label') }}" :dataList="$labels" class="form-control form-control-lg"/>
                        <x-form-text-aria-field label="{{ __('views.task.edit.description') }}" name="description" value="{{ $task->description }}" class="form-control form-control-lg"/>
                        <x-form-required-drop-down-list label="{{ __('views.task.edit.status') }}" name="status_id" value="{{ $task->status_id }}" placeholder="{{ __('views.task.edit.status') }}" message="{{ $message ?? '' }}" :dataList="$statuses" class="form-control form-control-lg"/>
                        <x-form-drop-down-list label="{{ __('views.task.edit.assignee') }}" name="assigned_to_id" value="{{ $task->assigned_to_id }}" placeholder="{{ __('views.task.edit.assignee') }}" :dataList="$users" class="form-control form-control-lg"/>
                        <x-form-submit-button name="{{ __('views.task.edit.update') }}" class="btn btn-primary px-5 text-uppercase"/>
                    {{ Form::close() }}
                </div>
        </div>
    </div>
@endsection