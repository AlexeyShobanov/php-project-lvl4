@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('views.label.index.header') }}</h1>
        <div class="table-responsive">
            @auth
                <x-link name="{{ __('views.label.index.new') }}" route="{{ route('labels.create') }}" class="btn btn-primary text-uppercase"/>
            @endauth
            <div class="container">
                <table class="table mt-2">
                    <tr>
                        <th>{{__('views.label.index.name')}}</th>
                        <th>{{__('views.label.index.description')}}</th>
                        <th>{{__('views.label.index.color')}}</th>
                        <th>{{__('views.label.index.created')}}</th>
                        @auth
                            <th class='text-center'>{{__('views.label.index.actions')}}</th>
                        @endauth
                    </tr>
                    @foreach($labels as $label)
                        <tr>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->color }}</td>
                            <td>{{ $label->created_at ?? ''}} </td>
                            <td class='text-center'>
                                @auth
                                    <x-link name="{{ __('views.label.index.edit') }}" route="{{ route('labels.edit', $label) }}" class="btn btn-sm btn-secondary"/>
                                    <x-delete-button name="{{ __('views.label.index.remove') }}" route="{{ route('labels.destroy', $label) }}" class="btn btn-sm btn-secondary"/>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $labels->links() }}
        </div>
    </div>
@endsection
