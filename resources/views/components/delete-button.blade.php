<div class="d-inline-block pb-1">
    {{ Form::open(['url' => $route, 'method' => 'DELETE', 'class' => 'mb-0']) }}
        {{ Form::submit($name, [$attributes, 'data-confirm' => __('flash.commonPhrases.sure'), 'rel' => "nofollow"]) }}
    {{ Form::close() }}
</div>