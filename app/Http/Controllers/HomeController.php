<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lightning;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $last_posts = Post::query()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->limit(13)->get();
        $posts1_4 = $last_posts->slice(0, 4);
        $posts5_8 = $last_posts->slice(4, 4);
        $post9 = $last_posts->slice(8, 1);
        $posts10_13 = $last_posts->slice(9, 4);

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

        $pop_news = Post::query()->with('category')->orderBy('views', 'desc')->limit(8)->get();
        $lightnings = Lightning::query()->orderBy('created_at', 'desc')->limit(10)->get();

        return view('index', compact( 'posts1_4', 'posts5_8', 'post9', 'posts10_13', 'main', 'carusel', 'lightnings', 'pop_news'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function categoryIndex()
    {
        $posts = DB::select('
            SELECT c.slug as category_slug, c.title as category_title, p.*
            FROM categories c
            JOIN posts p ON c.id = p.category_id
            WHERE (
                SELECT COUNT(*)
                FROM posts
                WHERE posts.category_id = c.id AND posts.created_at <= p.created_at
            ) <= 4
            ORDER BY c.id, p.created_at DESC
        ');


        return view('categories', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function categoryShow(string $slug)
    {
        $category = Category::query()
            ->with('posts')
            ->where('slug', '=', $slug)
            ->first();
        $posts = Post::query()
            ->where('category_id', '=', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('category', compact('category', 'posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function postShow(string $slug)
    {
        $lightnings = Lightning::query()->get();
        $post = Post::query()
            ->with('category', 'tags')
            ->where('slug', '=', $slug)
            ->first();
        $post->views++;
        $post->save();
        return view('single', compact('lightnings', 'post'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $query = $request->validate([
            's' => 'required',
        ]);
        $posts = DB::table('posts')
            ->select(
                'categories.id as category_id',
                'categories.slug as category_slug',
                'categories.title as category_title',
                'posts.*')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->where('posts.title', 'like', "%{$query['s']}%")
            ->orWhere('posts.content', 'like', "%{$query['s']}%")
            ->orderBy('posts.created_at', 'desc')
            ->get();
//        dd($posts);
        return view('search', compact('posts', 'query'));
    }
}
