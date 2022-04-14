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

        Post::create([
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);

        return redirect()->route('post.index');
    }
}
