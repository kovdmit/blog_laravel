<?php

namespace App\Http\Controllers;

use App\Models\Lightning;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $last_posts = Post::query()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->limit(13)->get();
        $posts1_4 = $last_posts->slice(0, 4);
        $posts5_6 = $last_posts->slice(4, 2);
        $posts7_8 = $last_posts->slice(6, 2);
        $post9 = $last_posts->slice(8, 1);
        $posts10_11 = $last_posts->slice(9, 2);
        $posts12_13 = $last_posts->slice(11, 2);

        $post_main = Post::query()
            ->with('category')
            ->where('main', '=', '1')
            ->orWhere('carusel', '=', '1')
            ->orderBy('created_at', 'desc')
            ->get();
        $main = [];
        $carusel = [];
        foreach ($post_main as $post) {
            if ($post->main == 1 && count($main) < 4) {
                $main[] = $post;
            }
            if ($post->carusel == 1) {
                $carusel[] = $post;
            }
        }

        $lightnings = Lightning::query()->orderBy('created_at', 'desc')->limit(10)->get();

        return view('index', compact( 'posts1_4', 'posts5_6', 'posts7_8', 'post9', 'posts10_11', 'posts12_13', 'main', 'carusel', 'lightnings'));
    }
}
