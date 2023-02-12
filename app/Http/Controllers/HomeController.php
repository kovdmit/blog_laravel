<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with('category', 'tags')
            ->orderBy('created_at', 'desc')
            ->limit(13)->get();
        $posts1_4 = $posts->slice(0, 4);
        $posts5_6 = $posts->slice(4, 2);
        $posts7_8 = $posts->slice(6, 2);
        $post9 = $posts->slice(8, 1);
        $posts10_11 = $posts->slice(9, 2);
        $posts12_13 = $posts->slice(11, 2);

        return view('index', compact( 'posts1_4', 'posts5_6', 'posts7_8', 'post9', 'posts10_11', 'posts12_13'));
    }
}
