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
        <h1> Tombos </h1>
        <table style="width:100%">
        @if(count($photos) > 0)
            @foreach($photos as $photo)
                <tr>
                    <td><ul>{{$photo->tombo}}</ul></td>
                    <td><ul>{{$institution_names[$photo->id]}}</ul></td>
                </tr>
            @endforeach
        @else
            <p>No tombos to see here.</p>
        @endif
    </table>
    {{-- <body> --}}
    @endsection
</html>