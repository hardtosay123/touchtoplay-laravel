<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(["index","show"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = blog::orderBy('created_at', 'DESC')->paginate(5);

        return view('blog.index')->with('posts', $blog);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']
        ]);

        $user_id = Auth::id();

        $addPost = blog::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $user_id
        ]);
        
        return redirect("/myposts");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(blog $community)
    {
        return view('blog.show')->with('post', $community);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(blog $community)
    {
        if (Auth::check() && $community->user_id === Auth::id()|| Auth::user()->is_admin === 1)
        {
            return view('blog.edit')->with('post', $community);
        }
        return abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blog $community)
    {
        if ($community->user_id === Auth::id() || Auth::user()->is_admin === 1)
        {
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string']
            ]);
    
            blog::where('id', $community->id)->update([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);
            
            return redirect("/community/$community->id");
        }

        return abort(401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(blog $community)
    {
        if ($community->user_id === Auth::id() || Auth::user()->is_admin === 1)
        {
            comment::where('blog_id', $community->id)->delete();
            blog::where('id', $community->id)->delete();
            
            return redirect()->back();
        }

        return abort(401);
    }
}
