@extends('layouts.default')
{{ HTML::style('css/inst.index.css'); }}
{{-- <!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head> --}}


    @section('content')
        {{-- <body> --}}
        {{$titulo = '';}}
        @if($selected != NULL)
            {{$titulo = 'de '.$selected->name;}}
        @endif
        <h1> Tombos {{$titulo}}</h1>
        <table style="width:100%">
        {{ Form::open(['action' => 'PhotosController@filterTombos', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        {{Form::select('institution', $names)}}
        {{Form::submit('Filtrar', ['class'=>'btn btn-primary'])}}
        {{ Form::close() }}
        <a href="/tombos">Todas</a href>
        <tr>
            <td><ul>Tombo</ul></td>
            <td><ul>Insituição</ul></td>
        @if(count($photos) > 0)
            @foreach($photos as $photo)
                
                    @if($selected == NULL or $selected->id == $photo->institution_id)
                        <td><ul>{{$photo->tombo}}</ul></td>
                        <td><ul>{{$names[institution_id]->name}}</ul></td>
                    @endif
                </tr>
            @endforeach
        @else
            <p>Não há Tombos a serem mostrados.</p>
        @endif
    </table>
    {{-- <body> --}}
    @endsection
</html>