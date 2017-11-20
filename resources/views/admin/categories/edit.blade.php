@extends('layouts.admin')

@section('content')
    <h1>Editar Categoria</h1>
    <br><br>

    @include('includes.errors')

    <div class="col-md-12">
        {!! Form::model($category,['method' => 'PATCH', 'action' => ['AdminCategoriesController@update',$category->id]]) !!}
        <div class="form-group">
            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', null,['class'=>'form-control','']); !!}
        </div>
        <div class="form-group">
            {{ Form::button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-primary col-md-3 col-md-offset-3', 'type' => 'submit']) }}
        </div>
        {!! Form::close() !!}
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy',$category->id]]) !!}
        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Deletar', ['class' => 'btn btn-danger col-md-3 col-md-offset-1 deletar', 'type' => 'submit']) }}
        {!! Form::close() !!}
        @include("includes.delete-warning")
    </div>


@endsection