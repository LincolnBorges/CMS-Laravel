@extends('layouts.admin')

@section('content')

    <h1>Edita Usuário</h1>
    <br>
    <br>

    <div class="row">
        @include('includes.errors')
    </div>

    <div class="col-md-3">
        <img src="{{$user->photo ? $user->photo->file : '/images/user-profile-placeholder.png'}}" width="200" class="img-responsive img-circle">
    </div>
    <div class="col-md-9">
        {!! Form::model($user,['method' => 'PATCH', 'action' => ['AdminUsersController@update',$user->id], 'files' => true]) !!}
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
            {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>


@endsection