@extends('game.layouts.app')

@section('title'){{ $game->title }} - Game - {{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<iframe id="gameIframe" src="{{ url("/game/$game->id/gameonly") }}" frameborder="0" style="position:absolute; background-color: white;" width="100%" height="100%"></iframe>
@endsection