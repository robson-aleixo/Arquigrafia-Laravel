@extends('layouts.default')
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
        <h1> TAGS </h1>
        <a href="/tags/create">Criar nova tag</a href>
        <table style="width:100%">
        @if(count($tags) > 0)
            @foreach($tags as $tag)
                <tr>
                    <td><ul>{{$tag->name}}</ul></td>
                    @if($tag->is != 0)
                        <td>Equivale a {{$tags->find($tag->is)->name}}</td>
                    @else
                        <td></td>
                    @endif
                    <td><a href="/tags/{{$tag->id}}/edit">Editar</a href></td>
                    <td>{{Form::open(['action' => ['modules\collaborative\controllers\TagsController@destroy', $tag->id], 'method' => 'POST'])}}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Excluir')}}
                    {{Form::close()}}</td>
                </tr>
            @endforeach
        @else
            <p>Woops.</p>
        @endif
    </table>
    {{-- <body> --}}
    @endsection
</html>