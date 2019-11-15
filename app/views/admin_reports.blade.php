<html>
@extends('layouts.default')
<head>
    <title>Relatórios</title>
     <meta charset="UTF-8">
</head>
@section('content')
    <div class='container'>
        <div class="columns">
            <hgroup class="profile_block_title">
                <h1><img src="{{ asset("img/logo-mini.png") }}" width="16" height="16"/>
                Relatórios de administrador:
                </h1>
            </hgroup>
            <div class="container">
                <ul style="list-style-type:square">
                    <li><a href="/tags">Relatório de Tags</a href></li>
                    <li><a href="/tombos">Relatório de Tombos</a href></li>
                <ul>
            </div>
        </div>
    </div>
@endsection