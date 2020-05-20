@extends('layouts.app')

@section('content')
    
    <div class="jumbotron">
        <h1 class="display-4">{{ __('views.welcome.header') }}</h1>
        <p class="lead">{{ __('views.welcome.introduction') }}</p>
        <hr class="my-4">
        <p>{{ __('views.welcome.hexletProject') }}</p>
        <a class="btn btn-primary btn-lg" href="https://hexlet.io" role="button">{{ __('views.welcome.learnMore') }}</a>
    </div>
@endsection