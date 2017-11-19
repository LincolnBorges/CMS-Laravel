@extends('layouts.admin')


@section('content')

    <h1>Gerenciando Fotos</h1>

    @if(Session::has('deleted_photo'))
        <div class="alert alert-danger">{{session('deleted_photo')}}</div>
    @endif

    <div class="col-md-8 col-md-offset-2">
        @if(!empty($photos))
            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($photos as $photo)
                    <tr>
                        <td><img src="{{$photo->file}}" width="100" class="img-responsive img-rounded"></td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy',$photo->id],'style'=>'display: inline-block;']) !!}
                            {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Deletar', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>Nenhuma foto no servidor</h3>
        @endif
    </div>

@endsection