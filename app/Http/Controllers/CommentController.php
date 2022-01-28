<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{

    public function store()
    {
        request()->validate(['art' => 'exists:art,id', 'text' => 'required|string']);
        if (!auth()->check())
            return back()->with('failed', 'Belum Login');
        Comment::create(['art_id' => request('art'), 'user_id' => auth()->user()->id, 'message' => request('text')]);
        return back();
    }

    public function update(Comment $comment)
    {
        request()->validate(['art' => 'exists:art,id', 'text' => 'required|string']);
        $comment->update(['art_id' => request('art'), 'user_id' => auth()->user()->id, 'message' => request('text')]);
        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
