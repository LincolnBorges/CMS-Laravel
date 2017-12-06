@extends('layouts.admin')

@section('content')
    <h1>Respostas ao comentário</h1>
    <br><br>

    @include('includes.sweetalert2')

    @if(count($replies)>0)
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th>Comentário</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Mensagem</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($replies as $reply)
                <tr>
                    <td><a href="{{route('home.post', $reply->comment->post->slug)}}" target="_blank">{{$reply->comment->post->title}}</a></td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{str_limit($reply->body,10)}}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy',$reply->id],'style'=>'display: inline-block;']) !!}
                        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Deletar', ['class' => 'btn btn-danger deletar', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                        @include("includes.delete-warning")

                        {!! Form::open(['method'=>'POST', 'action'=>['CommentRepliesController@activate',$reply->id],'style'=>'display: inline-block;']) !!}
                        @if(!$reply->is_active)
                            {{ Form::hidden('is_active', '1') }}
                            {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i> Aprovar', ['class' => 'btn btn-warning', 'type' => 'submit']) }}
                        @else
                            {{ Form::hidden('is_active', '0') }}
                            {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> Desaprovar', ['class' => 'btn btn-warning', 'type' => 'submit']) }}
                        @endif
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3>Sem comentários</h3>
    @endif
@endsection