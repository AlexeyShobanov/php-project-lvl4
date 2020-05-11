@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container py-4">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                     <h1  class="mb-5">{{__('messages.editTask')}}</h1>    
                {{ Form::open(['url' => route('tasks.update', $task->id), 'class' => 'justify-content-center', 'method' => 'PATCH']) }}
                    <div class="form-group">
                        <label for="name">{{__('messages.name')}}</label>
                        {{ Form::text('name', $task->name, ['class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : '')]) }}
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="label_id">{{__('messages.label')}}</label>
                        {{ Form::select('label_id', $labels, $task->label_id, ['placeholder' => __('messages.label'), 'class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('messages.description')}}</label>
                        {{ Form::textarea('description', $task->description ?? '', ['class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        <label for="status_id">{{__('messages.status')}}</label>
                        {{ Form::select('status_id', $statuses, $task->status_id, ['placeholder' => __('messages.status'), 'class' => 'form-control form-control-lg' . ($errors->has('status_id') ? ' is-invalid' : '')]) }}
                        @error('status_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="assigned_to_id">{{__('messages.assignee')}}</label>
                        {{ Form::select('assigned_to_id', $users, $task->assigned_to_id, ['placeholder' => __('messages.assignee'), 'class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit(__('messages.update'), ['class' => 'btn btn-primary px-5 text-uppercase']) }}
                    </div>       
                {{ Form::close() }}
                </div>
        </div>
    </div>
@endsection