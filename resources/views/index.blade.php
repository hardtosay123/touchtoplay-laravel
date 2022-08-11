@extends('layouts.app')

@section('title'){{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<div class="min-vh-100">
    <div class="container">
        <div class="row">
            @if ($games->count() > 0)
                @foreach ($games as $game)
                    @if ($game->release === 1)
                        <div class="col-6 col-md-4 col-lg-3 py-3">
                            <a href="{{ url("/game/$game->id") }}" class="text-decoration-none text-reset" target="_blank">
                                <div class="bg-white border rounded h-fixed cursor-pointer boxshadow">
                                    <div style="background-image: url('{{ $game->image_url }}'); background-repeat:no-repeat;background-size:cover; background-position:center" class="img-fixed w-100 border">
                                        
                                    </div>
                                    <div class="w-100 p-3">
                                        <p class="mb-1 font-weight-bold text-break">{{ $game->title }}</p>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <span id="status-color-{{ $game->id }}" class="mr-2 border indicator-status {{ ($game->status === 1)? 'status-on' : 'status-maintenance' }}"></span>
                                            <span id="status-game-{{ $game->id }}">{{ ($game->status === 1)? 'On' : 'Maintenance' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="col-12">
                    <div class="w-100 bg-white p-2">
                        <h3 class="text-center mb-0">No Games in a while</h3>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">
                    {{ $games->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection