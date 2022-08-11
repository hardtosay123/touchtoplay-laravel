<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function game(game $gameid)
    {
        if ($gameid->release === 1) {
            return view('game.gameonly')->with('game', $gameid);
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gameapp(game $gameid)
    {
        if ($gameid->release === 1) {
            return view('game.gameapp')->with('game', $gameid);
        }
        return abort(404);
    }
}
