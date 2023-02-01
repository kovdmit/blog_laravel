<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::paginate(2);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'unique:categories'
        ]);
        Category::create($validated);
        $title = $validated['title'];
        $request->session()->flash('success', "Категория \"$title\" успешно добавлена");
        return redirect(route('categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($slug)
    {
        $category = Category::query()->where('slug', '=', $slug)->first();
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $slug)
    {
        $category = Category::query()->where('slug', '=', $slug)->first();
        $old_title = $category->title;
        $request->validate([
            'title' => 'required',
        ]);
        $category->update($request->all());
        $new_title = $category->title;
        $request->session()->flash('success', "Категория \"$old_title\" успешно переименована в \"$new_title\"");
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $slug)
    {
        $category = Category::query()->get()->where('slug', '=', $slug)->first();
        $title = $category->title;
        $category->delete();
        $request->session()->flash('success', "Удаление категории $title завершено успешно.");
        return redirect()->route('categories.index');
    }
}
