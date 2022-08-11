<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\game;

class HomeController extends Controller
{
    public function index()
    {
        $games = game::orderBy('created_at', 'DESC')->paginate(12);

        return view('index')->with('games', $games);
    }
}
