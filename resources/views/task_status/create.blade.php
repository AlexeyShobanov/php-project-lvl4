@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container py-4">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                    <h1  class="mb-5">Add New Task Status</h1>
                    <div class="form-group">
                        <label for="name">Name</label>
                            {{ Form::open(['url' => route('task_statuses.store'), 'class' => 'd-flex justify-content-center']) }}
                                {{ Form::text('name', request()->name, ['class' => 'form-control form-control-lg']) }}
                                {{ Form::submit('Create', ['class' => 'btn btn-lg btn-primary ml-3 px-5 text-uppercase']) }}
                            {{ Form::close() }}
                    </div>
                </div>
        </div>
    </div>
@endsection