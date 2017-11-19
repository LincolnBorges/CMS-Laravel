@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" />
@endsection

@section('content')

    <h1>Upload de fotos</h1>
    <br>
    <br>

    @include('includes.errors')

    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediaController@store', 'class'=>'dropzone', 'files'=>true, 'id'=>'my-awesome-dropzone']) !!}

    {!! Form::close() !!}

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
@endsection