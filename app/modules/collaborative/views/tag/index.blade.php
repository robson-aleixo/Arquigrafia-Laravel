@extends('layouts.default')

    @section('content')
        <h1> TAGS </h1>
        <a href="/tags/create">Criar nova tag</a href>
        <h2>Tags de Acervo</h2>
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
    <h2>Tags de Usuário</h2>
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
    @endsection
</html>