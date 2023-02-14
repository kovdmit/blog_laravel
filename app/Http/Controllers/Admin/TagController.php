<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'unique:categories'
        ]);
        Tag::create($validated);
        $title = $validated['title'];
        return redirect()->route('tags.index')->with('success', "Тег \"$title\" успешно добавлен");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $tag = Tag::query()->where('slug', '=', $slug)->first();
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(Request $request, string $slug)
    {
        $tag = Tag::query()->where('slug', '=', $slug)->first();
        $old_title = $tag->title;
        $request->validate([
            'title' => 'required',
        ]);
        $tag->update($request->all());
        $new_title = $tag->title;
        return redirect()->route('tags.index')->with('success', "Тег \"$old_title\" успешно переименован в \"$new_title\"");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return RedirectResponse
     */
    public function destroy(string $slug)
    {
        $tag = Tag::query()->get()->where('slug', '=', $slug)->first();
        $title = $tag->title;
        $tag->delete();
        return redirect()->route('tags.index')->with('success', "Удаление тега \"$title\" завершено успешно.");
    }
}
