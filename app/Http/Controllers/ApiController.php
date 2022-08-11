<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\comment;
use App\Models\passcode;
use App\Models\game;
use App\Models\debugging;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class ApiController extends Controller
{
    public function get_comments(blog $id)
    {
        $comments = comment::join('users', 'comments.user_id', '=', 'users.id')
                            ->where('blog_id', $id->id)
                            ->select('comments.comment', 'comments.created_at', 'comments.user_id', 'users.name as user_name')
                            ->orderBy('comments.created_at', 'ASC')
                            ->get();
        return response()->json($comments, 200);
    }

    public function game_control_debug_tmp(Request $request, game $gameid)
    {
        $passcode = passcode::select('passcode')->limit(1)->get();
        
        if ($request->has('passcode') && $request->input('passcode') === $passcode[0]->passcode) {
            $rules = array(
                'user_id' => ['required', 'regex:/^\d+$/i', 'exists:users,id'],
                'script' => ['required', 'string']
            );
            $validator = Validator::make($request->all(), $rules);
        
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()], 400);
            }
            else {
                $debug = debugging::create([
                    'script' => $request->input('script'),
                    'game_id' => (int) $gameid->id,
                    'user_id' => (int) $request->input('user_id')
                ]);
    
                $success = [
                    'id' => $debug->id
                ];
                return response()->json(['success' => $success], 200);
            }
        }

        return response()->json(["error" => "Unauthorized"], 401);
    }

    public function game_control_debug_history(Request $request, game $gameid)
    {
        $passcode = passcode::select('passcode')->limit(1)->get();
        
        if ($request->has('passcode') && $request->input('passcode') === $passcode[0]->passcode) {
            $debugData = debugging::join('users', 'debuggings.user_id', '=', 'users.id')
                            ->where('debuggings.game_id', '=', $gameid->id)
                            ->select('debuggings.id as id', 'debuggings.script', 'debuggings.created_at', 'users.id as user_id', 'users.name as user_name')
                            ->orderBy('debuggings.created_at', 'DESC')
                            ->get();
                            
            return response()->json($debugData, 200);
        }

        return response()->json(["error" => "Unauthorized"], 401);
    }
}
