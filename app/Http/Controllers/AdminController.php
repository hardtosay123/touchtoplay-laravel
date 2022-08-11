<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\passcode;
use App\Models\game;
use App\Models\debugging;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function passcode_index()
    {
        $passcodes = passcode::select('passcode')->limit(1)->get();
        return view('admin.passcodes.index')->with('passcodes', $passcodes);
    }

    public function passcode_edit()
    {
        $passcodes = passcode::select('passcode')->limit(1)->get();
        return view('admin.passcodes.edit')->with('passcodes', $passcodes);
    }

    public function passcode_update(Request $request)
    {
        $request->validate([
            'passcode' => 'required|string|min:8|max:255|regex:/^\w+$/'
        ]);

        passcode::where('id', 1)->update([
            'passcode' => $request->input('passcode')
        ]);

        return redirect('/admin/passcodes')->with(['message' => 'Passcode Changed Successfully!']);
    }

    public function account_index(Request $request)
    {
        if ($request->has('search') && !empty($request->input('search')))
        {
            $accounts = User::where('email', 'LIKE', '%'.$request->input('search').'%')->paginate(5);
        }
        else
        {
            $accounts = User::paginate(5);
        }
        
        return view('admin.accounts.index')->with('accounts', $accounts);
    }

    public function account_update(Request $request, User $userid)
    {
        $request->validate([
            'admin' => [
                'required',
                'min:1',
                'max:1',
                function ($attribute, $value, $fail) {
                    if (!($value === '0' || $value === '1')) {
                        $fail($attribute.'\'s value is not valid.');
                    }
                }
            ]
        ]);

        User::where('id', $userid->id)->update([
            'is_admin' => ($request->input('admin') === '1') ? 1 : 0
        ]);
        
        return redirect()->route('adminaccounts', ['search' => ($request->has('search')) ? $request->input('search') : '']);
    }

    public function game_index()
    {
        return view('admin.games.index');
    }

    public function game_control_index(Request $request)
    {
        if ($request->has('search') && !empty($request->input('search')))
        {
            $games = game::where('title', 'LIKE', '%'.$request->input('search').'%')->orderBy('id', 'DESC')->paginate(10);
        }
        else
        {
            $games = game::orderBy('id', 'DESC')->paginate(10);
        }
        return view('admin.games.control.index')->with('games', $games);
    }

    public function game_control_update(Request $request, game $gameid)
    {
        $message = [];
        if ($request->has('release') && ($request->input('release') == '0' || $request->input('release') === '1')) {
            $request->validate([
                'release' => [
                    'required',
                    'min:1',
                    'max:1',
                    function ($attribute, $value, $fail) {
                        if (!($value === '0' || $value === '1')) {
                            $fail($attribute.'\'s value is not valid.');
                        }
                    }
                ]
            ]);
            game::where('id', $gameid->id)->update([
                'release' => ($request->input('release') === '1') ? 1 : 0
            ]);
            array_push($message, "Release has been updated!");
        }
        if ($request->has('status') && ($request->input('status') == '0' || $request->input('status') === '1')) {
            $request->validate([
                'status' => [
                    'required',
                    'min:1',
                    'max:1',
                    function ($attribute, $value, $fail) {
                        if (!($value === '0' || $value === '1')) {
                            $fail($attribute.'\'s value is not valid.');
                        }
                    }
                ]
            ]);
            game::where('id', $gameid->id)->update([
                'status' => ($request->input('status') === '1') ? 1 : 0
            ]);
            array_push($message, "Status has been updated!");
        }
        
        return redirect()->route('admingamescontrol', ['search' => ($request->has('search')) ? $request->input('search') : '', 'page' => ($request->has('page')) ? $request->input('page') : ''])->with('message', $message);
    }

    public function game_control_edit(game $gameid)
    {
        return view('admin.games.control.edit')->with('game', $gameid)->with('passcode', passcode::select('passcode')->limit(1)->get());
    }

    public function game_control_edit_update(Request $request, game $gameid)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'script' => ['required', 'string'],
            'image_url' => ['required', 'string'],
            'release' => [
                'required',
                'min:1',
                'max:1',
                function ($attribute, $value, $fail) {
                    if (!($value === '0' || $value === '1')) {
                        $fail($attribute.'\'s value is not valid.');
                    }
                }
            ],
            'status' => [
                'required',
                'min:1',
                'max:1',
                function ($attribute, $value, $fail) {
                    if (!($value === '0' || $value === '1')) {
                        $fail($attribute.'\'s value is not valid.');
                    }
                }
            ]
        ]);

        game::where('id', $gameid->id)->update([
            'title' => $request->input('title'),
            'script' => $request->input('script'),
            'image_url' => $request->input('image_url'),
            'release' => ($request->input('release') === '1') ? 1 : 0,
            'status' => ($request->input('status') === '1') ? 1 : 0
        ]);


        $search = ($request->has('search')) ? $request->input('search') : '';
        $page = ($request->has('page')) ? $request->input('page') : '';
        $message = "Update Successfully!";

        return redirect("/admin/games/control/$gameid->id/edit?page=$page&search=$search")->with('message', $message);
    }

    public function game_control_edit_debug(debugging $debugid)
    {
        return view('admin.games.control.debug')->with('debug', $debugid);
    }

    public function game_upload()
    {
        return view('admin.games.upload.create');
    }

    public function game_upload_create(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'script' => ['required', 'string'],
            'image_url' => ['required', 'string'],
            'release' => [
                'required',
                'min:1',
                'max:1',
                function ($attribute, $value, $fail) {
                    if (!($value === '0' || $value === '1')) {
                        $fail($attribute.'\'s value is not valid.');
                    }
                }
            ],
            'status' => [
                'required',
                'min:1',
                'max:1',
                function ($attribute, $value, $fail) {
                    if (!($value === '0' || $value === '1')) {
                        $fail($attribute.'\'s value is not valid.');
                    }
                }
            ]
        ]);

        game::create([
            'title' => $request->input('title'),
            'script' => $request->input('script'),
            'image_url' => $request->input('image_url'),
            'release' => ($request->input('release') === '1') ? 1 : 0,
            'status' => ($request->input('status') === '1') ? 1 : 0
        ]);

        $message = "Game create Successfully!";

        return redirect("/admin/games")->with('message', $message);
    }
}