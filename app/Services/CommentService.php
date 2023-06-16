<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Repositories\RepliesRepository;

class CommentService{
    protected $commentRepository;
    protected $repliesRepository;

    public function __construct(CommentRepository $commentRepository, RepliesRepository $repliesRepository){
        $this->commentRepository = $commentRepository;
        $this->repliesRepository = $repliesRepository;
    }

    public function getAll($id){
        $result = $this->commentRepository->index($id);
        return response()->json($result);
    }

    public function getReply($id){
        $result = $this->commentRepository->getReply($id);
        return response()->json($result);
    }

    public function store($request){
        $user_id = $request->header('google_id');

        $data = $request->only([
            'content',
            'name',
            'user_id' => $user_id,
            'post_id'
        ]);

        $result = $this->commentRepository->store($data);
        return response()->json($result);
    }

    public function reply($request){
        $data = $request->only([
            'reply',
            'name',
            'comment_id',
        ]);

        $result = $this->repliesRepository->store($data);
        return response()->json($result);
    }

    public function delete($id){
        
    }
}