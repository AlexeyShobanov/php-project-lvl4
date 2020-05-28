@extends('layouts.app')

@section('content')
<div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('views.task.index.header') }}</h1>
        <div class="table-responsive">
            <div class='d-flex'>
                <div>
                    {{ Form::open(['url' => route('tasks.index'), 'class' => 'form-inline', 'method' => 'GET']) }}
                        {{ Form::select("filter[created_by_id]", $users, $filter['created_by_id'] ?? null, ['placeholder' => __('views.task.index.creator'), 'class' => 'form-control mr-2', 'style' => 'width: 150px;']) }}
                        {{ Form::select("filter[assigned_to_id]", $users, $filter['assigned_to_id'] ?? null, ['placeholder' => __('views.task.index.assignee'), 'class' => 'form-control mr-2', 'style' => 'width: 150px;']) }}
                        {{ Form::select("filter[status_id]", $statuses, $filter['status_id'] ?? null, ['placeholder' => __('views.task.index.status'), 'class' => 'form-control mr-2', 'style' => 'width: 150px;']) }}
                        {{ Form::submit(__('views.task.index.apply'), ['class' => 'btn btn-outline-primary text-uppercase mr-2']) }}
                        <a class="btn btn-outline-primary text-uppercase mr-2" href="{{ route('tasks.index') }}">{{__('views.task.index.clear')}}</a>
                    {{ Form::close() }}
                </div>
            @auth
                <a class="btn btn-primary text-uppercase mb-3 ml-auto" href="{{ route('tasks.create') }}">{{__('views.task.index.new')}}</a>
            @endauth
            </div>

            <table class="table mt-2">
                <tr>
                    <th>{{__('views.task.index.id')}}</th>
                    <th>{{__('views.task.index.name')}}</th>
                    <th>{{__('views.task.index.status')}}</th>
                    <th>{{__('views.task.index.creator')}}</th>
                    <th>{{__('views.task.index.assignee')}}</th>
                    <th>{{__('views.task.index.created')}}</th>
                    @auth
                        <th class='text-center'>{{__('views.task.index.actions')}}</th>
                    @endauth
                </tr>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>
                            <div class="d-inline-block">
                            <a class="btn btn-link" href="{{ route('tasks.show', $task) }}"> {{ $task->name}} </a>
                            </div>
                            <div class="d-inline-block">
                                @foreach($task->labels as $label)
                                    <span class="badge badge-{{ $label ? $label->color->btn_style : '' }}"> {{ $label }} </span>
                                @endforeach   
                            </div>
                        </td>
                        <td> {{ $task->status }}</td>
                        <td>{{ $task->createdBy}}</td>
                        <td>{{ $task->assignedTo ?? ''}}</td>
                        <td>{{ $task->created_at}} </td>
                        <td class='text-center'>
                            @auth
                                @can('update', $task)
                                    <x-link name="{{ __('views.task.index.edit') }}" route="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-secondary"/>
                                @endcan
                                @can('delete', $task)
                                    <x-delete-button name="{{ __('views.task.index.remove') }}" route="{{ route('tasks.destroy', $task) }}" class="btn btn-sm btn-secondary"/>
                                @endcan
                            @endauth
                        </td>
                    </tr>
                @endforeach
                {{ $tasks->links() }}
            </table>
        </div>
    </div>
@endsection