@extends('layouts.blog-post')


@section('content')

    @include('includes.sweetalert2')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Postado a {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->body}}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Deixe um comentário:</h4>
        @include('includes.errors')

        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store', 'files' => true]) !!}
        {!! Form::hidden('post_id', $post->id); !!}
        <div class="form-group form-inline">
            {!! Form::label('body','Comentário:') !!}
            {!! Form::textarea('body', null,['class'=>'form-control','rows' => '3','style'=>'width:100%', 'required']); !!}
        </div>
        <div class="form-group">
            <br>
            {{ Form::button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-primary col-md-5', 'type' => 'submit', 'style'=>'margin:0']) }}
            <br>
        </div>
        {!! Form::close() !!}
    </div>
    <hr>
    <!-- Posted Comments -->

    <!-- Comment -->
    @foreach($post->comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{$comment->photo}}" width="50">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            {{$comment->body}}
        </div>
    </div>
    @endforeach
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            <!-- Nested Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Nested Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>
            <!-- End Nested Comment -->
        </div>
    </div>

@endsection