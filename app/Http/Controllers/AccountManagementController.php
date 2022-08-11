<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\passcode;
use Illuminate\Support\Facades\Hash;

class AccountManagementController extends Controller
{
    public function show_other_account(User $id)
    {
        return view('blog.account')->with('account', $id);
    }

    public function index(Request $request)
    {
        $passcodes = passcode::select('passcode')->limit(1)->get();
        if (Auth::check() && $request->has('passcode') && !empty($request->input('passcode')) && $request->input('passcode') === $passcodes[0]->passcode)
        {
            User::where('id', Auth::id())->update([
                'is_admin' => 1
            ]);
            return redirect('/management/account');
        }
        $account = User::where('id', Auth::id())->first();
        
        return view('account.index')->with('account', $account);
    }

    public function changepassword_index()
    {
        return view('account.changepassword');
    }

    public function changepassword_update(Request $request)
    {
        $request->validate([
            'currentpassword' => [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    $user_password = User::where('id', Auth::id())->first();
                    if (!(Hash::check($value, $user_password->password))) {
                        $fail('Your provided password is incorrect!');
                    }
                }
            ],
            'newpassword' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        User::where('id', Auth::id())->update([
            'password' => Hash::make($request->input('newpassword'))
        ]);

        return redirect('/management/account')->with(['message' => 'You have changed password successfully!']);
    }

    public function changename_update(Request $request)
    {
        $request->validate([
            'newname' => ['required', 'string', 'max:255']
        ]);

        User::where('id', Auth::id())->update([
            'name' => $request->input('newname')
        ]);

        return redirect('/management/account')->with(['message' => 'You have changed name successfully!']);
    }
}
