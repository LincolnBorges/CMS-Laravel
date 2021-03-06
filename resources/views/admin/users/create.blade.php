@extends('layouts.admin')

@section('content')

    <h1>Criar Usuário</h1>
    <br>
    <br>

    @include('includes.errors')

    {!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('name','Nome:') !!}
        {!! Form::text('name', null,['class'=>'form-control','required']); !!}
    </div>
    <div class="form-group">
        {!! Form::label('email','E-mail:') !!}
        {!! Form::email('email', null,['class'=>'form-control','required']); !!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Senha:') !!}
        {!! Form::password('password',['class'=>'form-control']); !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id','Permissão:') !!}
        {!! Form::select('role_id',$roles, null, ['class' => 'form-control','placeholder' => '-- Escolha --','required']); !!}
    </div>
    <div class="form-inline form-group">
        {!! Form::label('','Ativo:') !!}
        <div class="radio">
            <label>{!! Form::radio('is_active', '1', true, ['required']).' SIM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; !!}</label>
            <label>{!! Form::radio('is_active', '0', false, ['required']).' NÃO'; !!}</label>
        </div>
    </div>
    <div class="form-inline form-group">
        {!! Form::label('photo_id','Foto:') !!}
        {!! Form::file('photo_id',['class'=>'form-control']); !!}
    </div>
    <div class="form-group">
        <br>
        {{ Form::button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-primary col-md-6 col-md-offset-3', 'type' => 'submit']) }}
    </div>
    {!! Form::close() !!}

@endsection