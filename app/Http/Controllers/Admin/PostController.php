<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::query()->with('category', 'tags')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::query()->pluck('title', 'id')->all();
        $tags = Tag::query()->pluck('title', 'id')->all();
        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'nullable|image',
        ]);
        $data['thumbnail'] = Post::uploadImage($request);

        $post = Post::create($data);
        $post->tags()->sync($request->tags);
        $title = $data['title'];
        $request->session()->flash('success', "Публикакция \"$title\" успешно добавлена");
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $post = Post::query()->where('slug', '=', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return Application|Factory|View
     */
    public function edit($slug)
    {
        $post = Post::query()->where('slug', '=', $slug)->first();
        $categories = Category::query()->pluck('title', 'id')->all();
        $tags = Tag::query()->pluck('title', 'id')->all();
        return view('admin.posts.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  string $slug
     * @return RedirectResponse
     */
    public function update(Request $request, $slug)
    {
        $post = Post::query()->where('slug', '=', $slug)->first();
        $old_title = $post->title;
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'nullable|image',
        ]);
        if ($request->thumbnail) {
            $data['thumbnail'] = Post::uploadImage($request, $post->thumbnail);
        }

        $post->update($data);
        $post->tags()->sync($request->tags);
        $new_title = $post->title;
        return redirect()->route('posts.index')->with('success', "Публикация \"$old_title\" успешно переименована в \"$new_title\"");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return RedirectResponse
     */
    public function destroy($slug)
    {
        $post = Post::query()->get()->where('slug', '=', $slug)->first();
        $title = $post->title;
        $post->tags()->sync([]);
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('posts.index')->with('success', "Удаление поста \"$title\" завершено успешно.");
    }

    public function delImg($slug)
    {
        $post = Post::query()->get()->where('slug', '=', $slug)->first();
        Storage::delete($post->thumbnail);
        $post->thumbnail = '';
        $post->save();
        return back()->with('success', 'Удаление изображения успешно завершено.');
    }
}
