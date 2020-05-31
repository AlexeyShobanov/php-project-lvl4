@extends('layouts.app')

@section('content')
<div class="container-lg">
    <h1 class="mt-5 mb-3">{{ __('views.task_status.index.header') }}</h1>
    <div class="table-responsive">
        @auth
            <x-link name="{{ __('views.task_status.index.new') }}" route="{{ route('task_statuses.create') }}" class="btn btn-primary text-uppercase"/>
        @endauth
        <div class="container">
            <table class="table mt-2">
                <tr>
                    <th>{{__('views.task_status.index.name')}}</th>
                    <th>{{__('views.task_status.index.created')}}</th>
                    @if (Auth::user())
                        <th class='text-center'>{{__('views.task_status.index.actions')}}</th>
                    @endif
                </tr>
                @foreach($statuses as $status)
                    <tr>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->created_at ?? ''}} </td>
                        <td class='text-center'>
                            @auth
                                <x-link name="{{ __('views.task_status.index.edit') }}" route="{{ route('task_statuses.edit', $status) }}" class="btn btn-sm btn-secondary"/>
                                <x-delete-button name="{{ __('views.task_status.index.remove') }}" route="{{ route('task_statuses.destroy', $status) }}" class="btn btn-sm btn-secondary"/>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $statuses->links() }}
    </div>
</div>
@endsection
