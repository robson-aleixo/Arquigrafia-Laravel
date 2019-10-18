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
        <h1> INSTITUIÇÕES </h1>
        <table style="width:100%">
        @if(count($instituitions) > 0)
            @foreach($instituitions as $instituition)
                <tr>
                    <td><ul>{{$instituition->name}}</ul></td>
                    <td><ul>{{$instituition->photo}}</ul></td>
                </tr>
            @endforeach
        @else
            <p>Woops.</p>
        @endif
    </table>
    {{-- <body> --}}
    @endsection
</html>