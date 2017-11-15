@extends('layouts.admin')

@section('content')
    <h1>Usuários</h1>
    <br><br>
    <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Permissão</th>
            <th>Ativo</th>
            <th>Criado</th>
            <th>Atualizado</th>
          </tr>
        </thead>
        <tbody>
        @if($users)
        @foreach ($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active ? 'SIM' : 'NÃO'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
          </tr>
        @endforeach
        @endif
        </tbody>
    </table>
@endsection