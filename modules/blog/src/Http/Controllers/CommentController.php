<?php
namespace Blog\Http\Controllers;

use Blog\Http\Requests\CommentStoreRequest;
use Blog\Models\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request)
    {
        $data = $request->validated();

        $comment = Comment::create([
            'article_id' => $data['article_id'],
            'subject' => $data['subject'],
            'comment' => $data['comment'],
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
