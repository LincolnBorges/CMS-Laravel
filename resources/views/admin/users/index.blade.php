@extends('layouts.admin')

@section('content')
    <h1>Usuários</h1>
    <br><br>
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
            <td><img src="{{$user->photo ? $user->photo->file : '/images/user-profile-placeholder.png'}}" width="100" class="img-responsive img-circle"></td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active ? 'SIM' : 'NÃO'}}</td>
            <td>
                <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-info">
                    <i class="fa fa-edit"></i> Editar
                </a>
            </td>
          </tr>
        @endforeach
        @endif
        </tbody>
    </table>
@endsection