@extends('layouts.app')

@section('content')
    <div class="jumbotron-fluid bg-light">
        <div class="container py-4">
            <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                <h1  class="mb-5">{{__('views.comment.edit.header')}}</h1>
                {{ Form::model($comment, ['url' => route('tasks.comments.update', [$task, $comment]), 'class' => 'justify-content-center', 'method' => 'PATCH']) }}
                    <x-form-required-text-aria-field label="{{ __('views.comment.edit.content') }}" name="content" value="{{ $comment->content }}" message="{{ $message ?? '' }}" class="form-control form-control-lg"/>
                    <x-form-submit-button name="{{ __('views.comment.edit.update') }}" class="btn btn-primary px-5 text-uppercase"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
