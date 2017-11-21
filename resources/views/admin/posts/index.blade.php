@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
    <br><br>

    @include('includes.sweetalert2')

    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>Imagem</th>
            <th>Criador</th>
            <th>Categoria</th>
            <th>Título</th>
            <th>Texto</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach ($posts as $post)
                <tr>
                    <td><img src="{{$post->photo ? $post->photo->file : '/images/user-profile-placeholder.png'}}" width="100" class="img-responsive img-rounded"></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category ? $post->category->name : 'Sem categoria'}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{str_limit($post->body,10)}}</td>
                    <td>
                        <a href="{{route('home.post',$post->id)}}"  target="_blank" class="btn btn-warning">
                            <i class="fa fa-eye"></i> Visualizar
                        </a>
                        @if(count($post->comments) > 0)
                        <a href="{{route('admin.comments.show',$post->id)}}" class="btn btn-default">
                            <i class="fa fa-comment-o"></i> Comentários
                        </a>
                        @endif
                        <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-info">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy',$post->id],'style'=>'display: inline-block;']) !!}
                        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Deletar', ['class' => 'btn btn-danger deletar', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                        @include("includes.delete-warning")


                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection