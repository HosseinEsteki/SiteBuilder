<?php
namespace Blog\Services;

use Blog\Repositories\CommentRepository;
use Blog\Models\Comment;

class CommentService
{
    protected CommentRepository $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addComment(array $data, int $userId)
    {
        $data['user_id'] = $userId;
        $data['status'] = 'pending';
        return $this->repository->create($data);
    }

    public function approveComment(Comment $comment)
    {
        return $this->repository->update($comment, ['status' => 'approved']);
    }

    public function rejectComment(Comment $comment)
    {
        return $this->repository->update($comment, ['status' => 'rejected']);
    }
}
