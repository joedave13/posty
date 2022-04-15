<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->posts()->with(['user', 'likes'])->latest()->paginate(6);

        return view('user.index', compact('user', 'posts'));
    }
}
