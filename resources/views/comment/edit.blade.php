@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container py-4">
               <div class="col-12 col-md-10 col-lg-8 mx-auto text-left text-dark">
                <h1  class="mb-5">{{__('messages.editComment')}}</h1>
                {{ Form::model($comment, ['url' => route('tasks.comments.update', [$task, $comment->id]), 'class' => 'justify-content-center', 'method' => 'PATCH']) }}
                    <div class="form-group">
                        <label for="content">{{__('messages.content')}}</label>
                        {{ Form::textarea('content', $comment->content, ['class' => 'form-control form-control-lg']) }}
                    </div>
                    {{ Form::submit(__('messages.update'), ['class' => 'btn btn-primary px-5 text-uppercase']) }}
            </div>
        </div>
    </div>
@endsection