<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => ['required']
        ]);

        // Long Way
        // Post::create([
        //     'user_id' => Auth::id(),
        //     'body' => $request->body
        // ]);

        // Short Way
        Auth::user()->posts()->create([
            'body' => $request->body
        ]);

        return redirect()->route('post.index');
    }
}
