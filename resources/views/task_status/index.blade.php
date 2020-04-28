@extends('layouts.app')

@section('content')
<div class="container-lg">
        <h1 class="mt-5 mb-3">Task Status</h1>
        <div class="table-responsive">

            @if (Auth::user())

                {{ Form::open(['url' => route('task_statuses.create'), 'method' => 'GET']) }}
                    {{ Form::submit(__('messages.addNew'), ['class' => 'btn btn-primary text-uppercase']) }}
                {{ Form::close() }}

            @endif

            <table class="table mt-2">
                <tr>
                    <th class='text-center'>{{__('messages.id')}}</th>
                    <th>{{__('messages.name')}}</th>
                    <th class='text-center'>{{__('messages.createdAt')}}</th>
                    @if (Auth::user())
                        <th class='text-center'>{{__('messages.actions')}}</th>
                    @endif
                </tr>
                @foreach($statuses as $status)
                    <tr>
                        <td class='text-center'>{{ $status->id }}</td>
                        <td><a href="#">{{ $status->name }}</a></td>
                        <td class='text-center'>{{ $status->created_at ?? ''}} </td>
                        @if (Auth::user())
                            <td class='text-center'>
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('task_statuses.edit', $status->id), 'method' => 'GET']) }}
                                        {{ Form::submit(__('messages.edit'), ['class' => 'btn btn-sm btn-secondary']) }}
                                    {{ Form::close() }}
                                </div>
                           
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('task_statuses.destroy', $status->id), 'method' => 'DELETE']) }}
                                        {{ Form::submit(__('messages.delete'), ['class' => 'btn btn-sm btn-secondary', 'data-confirm' => "Are you sure?", 'rel' => "nofollow"]) }}
                                    {{ Form::close() }}
                                </div>
                        @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection