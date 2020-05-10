@extends('layouts.app')

@section('content')
<div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('messages.task') }}</h1>
        <div class="table-responsive">
            <div class='d-flex'>
                <div>
                    {{ Form::open(['url' => route('tasks.index'), 'class' => 'form-inline', 'method' => 'GET']) }}
                        {{ Form::select("filter[created_by_id]", $users, $filter['created_by_id'] ?? null, ['placeholder' => __('messages.creator'), 'class' => 'form-control mr-2', 'style' => 'width: 150px;']) }}
                        {{ Form::select("filter[assigned_to_id]", $users, $filter['assigned_to_id'] ?? null, ['placeholder' => __('messages.assignee'), 'class' => 'form-control mr-2', 'style' => 'width: 150px;']) }}
                        {{ Form::select("filter[status_id]", $statuses, $filter['status_id'] ?? null, ['placeholder' => __('messages.status'), 'class' => 'form-control mr-2', 'style' => 'width: 150px;']) }}
                        {{ Form::hidden("label", $labelFilter) }}
                        {{ Form::submit(__('messages.apply'), ['class' => 'btn btn-outline-primary text-uppercase mr-2']) }}
                        <a class="btn btn-outline-primary text-uppercase mr-2" href="{{ route('tasks.index') }}">{{__('messages.clear')}}</a>
                    {{ Form::close() }}
                   
                </div>

            @if (Auth::user())
                <a class="btn btn-primary text-uppercase mb-3 ml-auto" href="{{ route('tasks.create') }}">{{__('messages.addNew')}}</a>
            @endif
            </div>

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
                                <a class="btn btn-sm btn-{{ $task->label_style }}" href="{{ route('tasks.index') }}?label={{ $task->label_id }}{{ $filterStatusBar }}"> {{ $task->label_name }} </a>   
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
                                        {{ Form::submit(__('messages.edit'), ['class' => 'btn btn-sm btn-secondary', 'name' => 'b1']) }}
                                    {{ Form::close() }}
                                </div>
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('tasks.destroy', $task->id), 'method' => 'DELETE']) }}
                                        {{ Form::submit(__('messages.delete'), ['class' => 'btn btn-sm btn-secondary', 'data-confirm' => __('messages.areYouSure'), 'rel' => "nofollow"]) }}
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