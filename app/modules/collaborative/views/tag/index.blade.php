@extends('layouts.default')

<head>
    <title>Relatório de Tags</title>
    <meta charset="UTF-8">
  </head>

    @section('content')
        <h1> TAGS </h1>
        <a href="/tags/create">Clique aqui para criar uma nova tag de acervo</a href>
        <hr>
        <br>
        <div class="container">
        <div class="twelve columns">
        <h2>Tags de Acervo</h2>
        <div style="height:500px;width:500px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
        <table style="width:100%">
        @if(count($tags_a) > 0)
            @foreach($tags_a as $tag)
                <tr>
                    <td><ul>{{$tag->name}}</ul></td>
                    @if($tag->is != 0)
                        <td>Equivale a {{$tags_a->find($tag->is)->name}}</td>
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
            <p>Não há tags de acervo para mostrar.</p>
        @endif
    </table>
    </div>
    <br>
    <h2>Tags de Usuário</h2>
    <div style="height:500px;width:500px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
    <table style="width:100%">
            @if(count($tags_u) > 0)
                @foreach($tags_u as $tag)
                    <tr>
                        <td><ul>{{$tag->name}}</ul></td>
                    </tr>
                @endforeach
            @else
                <p>Não há tags de usuário para mostrar.</p>
            @endif
    </table>
    </div>
    </div>
    </div>
    @endsection
</html>