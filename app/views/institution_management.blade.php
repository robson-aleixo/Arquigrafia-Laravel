@extends('layouts.default')
{{ HTML::style('css/tombos.css'); }}
{{-- <!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head> --}}


    @section('content')
        <center>
        {{-- <body> --}}
        <h1>Empregados</h1>
        <table>
        <tr>
        @if(count($employees) > 0)
            <th><ul>Empregado</ul></th>
            <th><ul>Insituição</ul></th>
            @foreach($employees as $e)
                <tr>
                    <td><ul>{{$e['user']}}</ul></td>
                    <td><ul>{{$e['institution']}}</ul></td>
                </tr>
            @endforeach
        @else
            <p>Não há Empregados a serem mostrados.</p>
        @endif
        </tr>
    </table>
    </center>
    {{-- {{$employees->links()}} --}}
    {{-- <body> --}}
    @endsection
</html>