@extends('layouts.app')

@section('content')
<div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('messages.task') }}</h1>
        <div class="table-responsive">

            @if (Auth::user())

                {{ Form::open(['url' => route('tasks.create'), 'method' => 'GET']) }}
                    {{ Form::submit(__('messages.addNew'), ['class' => 'btn btn-primary text-uppercase']) }}
                {{ Form::close() }}

            @endif

            <table class="table mt-2">
                <tr>
                    <th class='text-center'>{{__('messages.id')}}</th>
                    <th>{{__('messages.status')}}</th>
                    <th>{{__('messages.name')}}</th>
                    <th>{{__('messages.creator')}}</th>
                    <th>{{__('messages.assignee')}}</th>
                    <th class='text-center'>{{__('messages.createdAt')}}</th>
                    @if (Auth::user())
                        <th class='text-center'>{{__('messages.actions')}}</th>
                    @endif
                </tr>
                @foreach($tasks as $task)
                    <tr>
                        <td class='text-center'>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <th>{{ $task->created_by_id->name}}</th>
                        <th>{{ $task->assigned_to_id->name ?? ''}}</th>
                        <td class='text-center'>{{ $task->created_at}} </td>
                        @if (Auth::user())
                            <td class='text-center'>
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('task.edit', $task->id), 'method' => 'GET']) }}
                                        {{ Form::submit(__('messages.edit'), ['class' => 'btn btn-sm btn-secondary']) }}
                                    {{ Form::close() }}
                                </div>
                        
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection