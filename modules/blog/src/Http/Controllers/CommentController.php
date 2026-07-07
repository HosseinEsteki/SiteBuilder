<?php
namespace Blog\Http\Controllers;

use Blog\Http\Requests\CommentStoreRequest;
use Blog\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request)
    {
        $data = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|string',
        ]);

        $comment = Comment::create([
            'article_id' => $data['article_id'],
            'user_id' => auth()->id(),
            'content' => $data['content'],
            'status' => 'pending',
        ]);

        return response()->json($comment, 201);
    }

    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);
        return response()->json($comment);
    }

    public function reject(Comment $comment)
    {
        $comment->update(['status' => 'rejected']);
        return response()->json($comment);
    }
}
