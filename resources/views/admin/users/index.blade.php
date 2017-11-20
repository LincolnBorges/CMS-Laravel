@extends('layouts.admin')

@section('content')
    <h1>Usuários</h1>
    <br><br>

    {{-- Mensagem depois das ações --}}
    @if(Session::has('created'))
        @section('scripts')
            <script>
                swal(
                    'Sucesso!',
                    '{{session("created")}}',
                    'success'
                )
            </script>
        @endsection
    @endif
    @if(Session::has('updated'))
        @section('scripts')
            <script>
                swal(
                    'Sucesso!',
                    '{{session("updated")}}',
                    'success'
                )
            </script>
        @endsection
    @endif
    @if(Session::has('deleted'))
        @section('scripts')
            <script>
                swal(
                    'Sucesso!',
                    '{{session("deleted")}}',
                    'success'
                )
            </script>
        @endsection
    @endif
    {{-- ------------------------- --}}


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
                        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Deletar', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                        @section('delete_warning')
                            <script>
                                $('button[type="submit"]').on('click',function(e){
                                    e.preventDefault();
                                    var form = $(this).parents('form');
                                    swal({
                                        title: "Tem certeza que deseja deletar?",
                                        text: "",
                                        type: "warning",
                                        showCancelButton: true,
                                        showLoaderOnConfirm: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Sim, pode deletar",
                                        cancelButtonText: "Não, quero cancelar",
                                        preConfirm: function() {
                                            return new Promise(function(resolve, reject) {
                                                form.submit();
                                                setTimeout(function() {
                                                    resolve();
                                                }, 2000);
                                            });
                                        }
                                    })
                                });
                            </script>
                        @endsection

                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection