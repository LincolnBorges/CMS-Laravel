@extends('layouts.admin')

@section('content')
    <h1>Editar Posts</h1>
    <br><br>

    @include('includes.errors')
    <div class="col-md-3">
        <img src="{{$post->photo ? $post->photo->file : '/images/user-profile-placeholder.png'}}" class="img-responsive img-rounded">
    </div>
    <div class="col-md-9">
        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update',$post->id], 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('title','Título:') !!}
            {!! Form::text('title', null,['class'=>'form-control','']); !!}
        </div>
        <div class="form-group form-inline">
            {!! Form::label('body','Conteúdo:') !!}
            {!! Form::textarea('body', null,['class'=>'form-control','rows' => '5','style'=>'width:100%']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id','Categoria:') !!}
            {!! Form::select('category_id',$category, null, ['class' => 'form-control','placeholder' => '-- Escolha --','required']); !!}
        </div>
        <div class="form-inline form-group">
            {!! Form::label('photo_id','Foto:') !!}
            {!! Form::file('photo_id',['class'=>'form-control']); !!}
        </div>
        <div class="form-group">
            <br>
            {{ Form::button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-primary col-md-6 col-md-offset-3', 'type' => 'submit']) }}
            <br>
        </div>
        {!! Form::close() !!}
    </div>
    

@endsection