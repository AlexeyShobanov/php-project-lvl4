@extends('layouts.app')

@section('content')
<div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('messages.labels') }}</h1>
        <div class="table-responsive">

            @auth
                <a class="btn btn-primary text-uppercase" href="{{ route('labels.create') }}">{{__('messages.addNew')}}</a>
            @endauth

            <table class="table mt-2">
                <tr>
                    <th>{{__('messages.name')}}</th>
                    <th>{{__('messages.description')}}</th>
                    <th>{{__('messages.color')}}</th>
                    <th>{{__('messages.createdAt')}}</th>
                    @auth
                        <th class='text-center'>{{__('messages.actions')}}</th>
                    @endauth
                </tr>
                @foreach($labels as $label)
                    <tr>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->color_name }}</td>
                        <td>{{ $label->created_at ?? ''}} </td>
                        <td class='text-center'>
                            @auth
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('labels.edit', $label->id), 'method' => 'GET']) }}
                                        {{ Form::submit(__('messages.edit'), ['class' => 'btn btn-sm btn-secondary']) }}
                                    {{ Form::close() }}
                                </div>
                                <div class="d-inline-block">
                                    {{ Form::open(['url' => route('labels.destroy', $label->id), 'method' => 'DELETE']) }}
                                        {{ Form::submit(__('messages.delete'), ['class' => 'btn btn-sm btn-secondary', 'data-confirm' => __('messages.areYouSure'), 'rel' => "nofollow"]) }}
                                    {{ Form::close() }}
                                </div>
                            @endauth
                        </td>
                    </tr>
                @endforeach
                {{ $labels->links() }}
            </table>
        </div>
    </div>
@endsection