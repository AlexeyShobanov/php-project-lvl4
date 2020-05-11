@extends('layouts.app')

@section('content')

    <div class="jumbotron-fluid bg-light">
        <div class="container py-4">
            <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
            <h1  class="mb-5">{{__('messages.addNewTask')}}</h1>    
                {{ Form::open(['url' => route('tasks.store'), 'class' => 'justify-content-center']) }}
                    <div class="form-group">
                        <label for="name">{{__('messages.name')}}</label>
                        {{ Form::text('name', request()->name, ['class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : '')]) }}
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="label_id">{{__('messages.label')}}</label>
                        {{ Form::select('label_id', $labels, null, ['placeholder' => __('messages.label'), 'class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('messages.description')}}</label>
                        {{ Form::textarea('description', request()->description, ['class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        <label for="status_id">{{__('messages.status')}}</label>
                        {{ Form::select('status_id', $statuses, $defaultStatus, ['placeholder' => __('messages.status'), 'class' => 'form-control form-control-lg' . ($errors->has('status_id') ? ' is-invalid' : '')]) }}
                        @error('status_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="assigned_to_id">{{__('messages.assignee')}}</label>
                        {{ Form::select('assigned_to_id', $users, null, ['placeholder' => __('messages.assignee'), 'class' => 'form-control form-control-lg']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit(__('messages.create'), ['class' => 'btn btn-primary px-5 text-uppercase']) }}
                    </div>       
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

