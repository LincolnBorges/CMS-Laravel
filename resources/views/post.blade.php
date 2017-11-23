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
    @if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Deixe um comentário:</h4>
        @include('includes.errors')

        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store', 'files' => true]) !!}
        {!! Form::hidden('post_id', $post->id); !!}
        <div class="form-group form-inline">
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
    @endif
    <!-- Comment -->
    @forelse($post->activeComments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{$comment->photo}}" width="64">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            {{$comment->body}}
        </div>
        <!-- Nested Comment -->
        <div class="media">
        @if(Auth::check())
            <!-- Comments Form -->
                <div class="">
                    @include('includes.errors')

                    {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply', 'files' => false]) !!}
                    {!! Form::hidden('comment_id', $comment->id); !!}
                    <div class="form-group form-inline">
                        {!! Form::label('body','Responder:') !!}
                        {!! Form::textarea('body', null,['class'=>'form-control','rows' => '2','style'=>'width:100%', 'required']); !!}
                    </div>
                    <div class="form-group">
                        {{ Form::button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-primary col-md-3', 'type' => 'submit', 'style'=>'margin:0']) }}
                        <br>
                    </div>
                    {!! Form::close() !!}
                </div>
                <hr>
                <!-- Posted Comments -->
            @endif
            @if(count($comment->activeReplies)>0)
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 0;">
                            <a data-toggle="collapse" href="#collapse{{$comment->id}}">
                                <h4 class="panel-title" style="padding: 10px;">
                                    Ver respostas
                                </h4>
                            </a>
                        </div>
                        <div id="collapse{{$comment->id}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                @foreach($comment->activeReplies as $commentreply)
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="{{$commentreply->photo}}" width="64">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$commentreply->author}}
                                                <small>{{$commentreply->created_at->diffForHumans()}}</small>
                                            </h4>
                                            {{$commentreply->body}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- End Nested Comment -->
    </div>
    @empty
        <h4>Nenhum comentário</h4>
    @endforelse

@endsection