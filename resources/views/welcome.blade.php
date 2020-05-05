@extends('layouts.app')

@section('content')
    
    <div class="jumbotron">
        <h1 class="display-4">{{ __('messages.taskManager') }}</h1>
        <p class="lead">{{ __('messages.introduction') }}</p>
        <hr class="my-4">
        <p>{{ __('messages.hexletProject') }}</p>
        <a class="btn btn-primary btn-lg" href="https://hexlet.io" role="button">{{ __('messages.learnMore') }}</a>
    </div>
@endsection