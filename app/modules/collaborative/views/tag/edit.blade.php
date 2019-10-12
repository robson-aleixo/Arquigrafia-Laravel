@extends('layouts.default')
    @section('content')
    {{-- <body> --}}
    <h1>Editar</h1>
    {{ Form::open(['action' => ['modules\collaborative\controllers\TagsController@update', $tagVec[0]->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        <div class="form-group">
            {{Form::label('name', 'Nome')}}
            {{Form::text('name', $tagVec[0]->name, ['class' => 'form-control', 'placeholder' => 'Nome'])}}
        </div>
        <div class="form-group">
            {{Form::label('descricao', 'Descrição')}}
            {{Form::text('description', $tagVec[0]->description, ['class' => 'form-control', 'placeholder' => 'Descrição'])}}
        </div>
        <div class="form-group">
            {{Form::label('categoria', 'Categoria')}}
            {{Form::text('category', $tagVec[0]->category, ['class' => 'form-control', 'placeholder' => 'Categoria'])}}
        
        <div class="form-group">
            {{Form::label('equivalencia', 'Equivalência')}}
            {{Form::text('is', $tagVec[1], ['class' => 'form-control', 'placeholder' => 'Equivalência'])}}

            
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {{ Form::close() }}
    {{-- </body> --}}
    @endsection