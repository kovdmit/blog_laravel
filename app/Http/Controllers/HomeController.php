<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::query()->orderBy('created_at', 'desc')->paginate(10);
        return view('index', compact('posts'));
    }
}
