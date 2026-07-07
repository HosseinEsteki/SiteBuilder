<?php
namespace Blog\Repositories;

use Blog\Models\Comment;

class CommentRepository
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update(Comment $comment, array $data)
    {
        $comment->update($data);
        return $comment;
    }
}
