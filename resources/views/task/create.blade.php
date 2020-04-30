@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container py-4">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                    <h1  class="mb-5">{{__('messages.addNewTask')}}</h1>
                    <div class="form-group">
                        <label for="name">{{__('messages.name')}}</label>
                            {{ Form::open(['url' => route('tasks.store'), 'class' => 'd-flex justify-content-center']) }}
                                {{ Form::text('name', request()->name, ['class' => 'form-control form-control-lg']) }}
                                {{ Form::submit(__('messages.create'), ['class' => 'btn btn-lg btn-primary ml-3 px-5 text-uppercase']) }}
                            {{ Form::close() }}
                    </div>
                </div>
        </div>
    </div>
@endsection