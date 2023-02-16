<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $post = Post::query()->where('slug', '=', $slug)->first();
        $data = $request->validate([
            'comment' => 'required'
        ]);
        $data['post_id'] = $post->id;
        $data['author_id'] = Auth::user()->id;
        Comment::create($data);
        return back()->with('success', 'Комментарий успешно добавлен.');
    }

    public function update(Request $request, $slug, $id)
    {
        return back()->with('success', 'Комментарий успешно изменен.');
    }

    public function destroy(Request $request, $slug, $id)
    {
        $comment = Comment::query()->find($id);
        if($comment->author != Auth::user() || Auth::user()->staff < 1) {
            return back()->with('error', 'Нельзя удалять чужие комментарии.');
        }
        $comment->delete();
        return back()->with('success', 'Комментарий успешно удалён.');
    }
}
