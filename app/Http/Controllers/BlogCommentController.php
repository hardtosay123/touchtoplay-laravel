<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function myposts()
    {
        $myposts = blog::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(5);
        return view('blog.myposts')->with('posts', $myposts);
    }

    public function mycomments()
    {
        $mycomments = comment::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('blog.mycomments')->with('comments', $mycomments);
    }

    public function addComment(Request $request, blog $community)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:255']
        ]);

        $user_id = Auth::id();
        $blog_id = $community->id;

        comment::create([
            'comment' => $request->input('comment'),
            'user_id' => $user_id,
            'blog_id' => $blog_id
        ]);

        return redirect("/community/$community->id");
    }
}
