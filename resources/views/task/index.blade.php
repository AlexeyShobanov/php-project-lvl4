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
                    <th>{{__('messages.id')}}</th>
                    <th>{{__('messages.name')}}</th>
                    <th>{{__('messages.status')}}</th>
                    <th>{{__('messages.creator')}}</th>
                    <th>{{__('messages.assignee')}}</th>
                    <th>{{__('messages.createdAt')}}</th>
                    @if (Auth::user())
                        <th class='text-center'>{{__('messages.actions')}}</th>
                    @endif
                </tr>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>
                            <div class="d-inline-block">
                            {{ $task->name}}
                            </div>
                            <div class="d-inline-block">
                                {{ Form::open(['url' => route('tasks.edit', $task->id), 'method' => 'GET']) }}
                                    {{ Form::submit($task->label_name, ['class' => 'btn btn-sm btn-' . $task->label_style]) }}
                                {{ Form::close() }}
                            </div>
                        </td>
                        <td>{{ $task->status_name }}</td>
                        <td>{{ $task->created_by_name}}</td>
                        <td>{{ $task->assigned_to_name ?? ''}}</td>
                        <td>{{ $task->created_at}} </td>
                        @if (Auth::user())
                            <td class='text-center'>
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('tasks.edit', $task->id), 'method' => 'GET']) }}
                                        {{ Form::submit(__('messages.edit'), ['class' => 'btn btn-sm btn-outline-secondary']) }}
                                    {{ Form::close() }}
                                </div>
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('tasks.destroy', $task->id), 'method' => 'DELETE']) }}
                                        {{ Form::submit(__('messages.delete'), ['class' => 'btn btn-sm btn-outline-secondary', 'data-confirm' => __('messages.areYouSure'), 'rel' => "nofollow"]) }}
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