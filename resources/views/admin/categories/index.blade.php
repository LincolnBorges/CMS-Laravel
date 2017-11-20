@extends('layouts.admin')

@section('content')
    <h1>Categorias</h1>
    <br><br>

    @include('includes.sweetalert2')

    <div class="col-sm-6">
        @include('includes.errors')

        {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', null,['class'=>'form-control','']); !!}
        </div>
        <div class="form-group">
            {{ Form::button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-primary col-md-6 col-md-offset-3', 'type' => 'submit']) }}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-sm-6">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @if($categories)
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-info">
                                <i class="fa fa-edit"></i> Editar
                            </a>

                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy',$category->id],'style'=>'display: inline-block;']) !!}
                            {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Deletar', ['class' => 'btn btn-danger deletar', 'type' => 'submit']) }}
                            {!! Form::close() !!}
                            @include("includes.delete-warning")


                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection