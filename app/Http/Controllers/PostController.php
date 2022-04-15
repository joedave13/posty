<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(3);
        return view('post.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => ['required']
        ]);

        Auth::user()->posts()->create([
            'body' => $request->body
        ]);

        return redirect()->route('post.index');
    }
}
