@extends('layouts.admin')

@section('content')
    <h1>Comentários</h1>
    <br><br>

    @include('includes.sweetalert2')

    @if(count($comments)>0)
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th>Post</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Mensagem</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td><a href="{{route('home.post', $comment->post->id)}}" target="_blank">{{$comment->post->title}}</a></td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{str_limit($comment->body,10)}}</td>
                    <td>
                        <a href="{{route('admin.users.edit',$comment->id)}}" class="btn btn-info">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy',$comment->id],'style'=>'display: inline-block;']) !!}
                        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Deletar', ['class' => 'btn btn-danger deletar', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                        @include("includes.delete-warning")

                        {!! Form::open(['method'=>'POST', 'action'=>['PostCommentsController@activate',$comment->id],'style'=>'display: inline-block;']) !!}
                        @if(!$comment->is_active)
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