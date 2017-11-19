@extends('layouts.admin')

@section('content')

    <h1>Criar Categoria</h1>
    <br>
    <br>

    @include('includes.errors')

    {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('name','Nome:') !!}
        {!! Form::text('name', null,['class'=>'form-control','']); !!}
    </div>
    <div class="form-group">
        <br>
        {{ Form::button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-primary col-md-6 col-md-offset-3', 'type' => 'submit']) }}
    </div>
    {!! Form::close() !!}

@endsection