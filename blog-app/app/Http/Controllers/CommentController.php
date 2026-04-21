<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'comment' => ['required', 'min:1', 'max:1000'],
        ]);

        $post->comments()->create([
            'comment' => $validated['comment'],
            'user_id' => $request->user()?->id,
        ]);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment added.');
    }

    public function destroy(Request $request, Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $postId = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show', $postId)
            ->with('success', 'Comment deleted.');
    }
}
