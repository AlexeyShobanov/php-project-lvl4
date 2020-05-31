@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Task: {{ $task->name }}</h1>
        <p class="lead">{{ $task->description }}</p>
        @auth
            {{ Form::open(['url' => route('tasks.comments.store', $task)]) }}
                <x-form.required-text-aria-field label="{{ __('views.task.show.comment') }}" name="content" message="{{ $message ?? '' }}" class="form-control w-50"/>
                <x-form.submit-button name="{{ __('views.task.show.create') }}" class="btn btn-primary px-5 text-uppercase"/>
            {{ Form::close() }}
        @endauth
        <hr>
        <h3 class="mt-3 mb-1">{{__('views.task.show.comments')}}</h3>
        <div class="container">
            <table class="table mt-2">
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->content}}</td>
                        <td>{{ $comment->createdBy}}</td>
                        <td>{{ $comment->created_at}} </td>
                        @auth
                            <td class='text-center'>
                                @can('update', $comment)
                                    <x-link name="{{ __('views.task.show.edit') }}" route="{{ route('tasks.comments.edit', [$task, $comment]) }}" class="btn btn-sm btn-secondary"/>
                                @endcan
                                @can('delete', $comment)
                                    <x-delete-button name="{{ __('views.task.show.remove') }}" route="{{ route('tasks.comments.destroy', [$task, $comment]) }}" class="btn btn-sm btn-secondary"/>
                                @endcan
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $comments->links() }}
    </div>
@endsection 
