@extends('layouts.app')

@section('content')
    <div class="jumbotron-fluid bg-light">
        <div class="container py-4">
            <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                <h1  class="mb-5">{{__('messages.addNewTaskStatus')}}</h1>
                {{ Form::open(['url' => route('task_statuses.store'), 'class' => 'justify-content-center']) }}
                <div class="form-group">
                    <label for="name">{{__('messages.name')}}</label>
                    {{ Form::text('name', request()->name, ['class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : '')]) }}
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{ Form::submit(__('messages.create'), ['class' => 'btn btn-primary px-5 text-uppercase']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
