@extends('layouts.app')

@section('content')
    
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Task: {{ $task->name }}</h1>
        <p class="lead">{{ $task->description }}</p>
        @if (Auth::user())
            {{ Form::open(['url' => route('tasks.comments.store', $task->id)]) }}
                <div class="form-group">
                    <label for="content">{{__('messages.comment')}}</label>
                    {{ Form::textarea('content', request()->content, ['class' => 'form-control w-50']) }}
                </div>
                {{ Form::submit(__('messages.create'), ['class' => 'btn btn-primary px-5 text-uppercase']) }}
            {{ Form::close() }}
        @endif
    <hr>
    <h3 class="mt-3 mb-1">{{__('messages.comments')}}</h3>
    <table class="table mt-2">
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->content}}</td>
                        <td>{{ $comment->created_by_name}}</td>
                        <td>{{ $comment->created_at}} </td>
                        @if (Auth::user())
                            <td class='text-center'>
                                <div class="d-inline-block pt-1 pb-1">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('tasks.comments.edit', [$task, $comment->id]) }}"> {{ __('messages.edit') }} </a>
                                </div>
                                <div class="d-inline-block pt-1 pb-1">
                                    {{ Form::open(['url' => route('tasks.comments.destroy', [$task, $comment->id]), 'method' => 'DELETE']) }}
                                        {{ Form::submit(__('messages.delete'), ['class' => 'btn btn-sm btn-secondary', 'data-confirm' => __('messages.areYouSure'), 'rel' => "nofollow"]) }}
                                    {{ Form::close() }}
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
    </div>

@endsection 