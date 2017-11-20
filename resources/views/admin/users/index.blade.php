@extends('layouts.admin')

@section('content')
    <h1>Usuários</h1>
    <br><br>

    @include('includes.sweetalert2')

    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>Photo</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Permissão</th>
            <th>Ativo</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach ($users as $user)
                <tr>
                    <td><img src="{{$user->photo ? $user->photo->file : '/images/user-profile-placeholder.png'}}" width="100" class="img-responsive img-rounded"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active ? 'SIM' : 'NÃO'}}</td>
                    <td>
                        <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-info">
                            <i class="fa fa-edit"></i> Editar
                        </a>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id],'style'=>'display: inline-block;']) !!}
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