<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentsController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }

    public function index(){
        return $this->commentService->getAll();
    }

    public function store(Request $request){
        return $this->commentService->store($request);
    }

    public function getReply($id){
        return $this->commentService->getReply($id);
    }

    public function reply(Request $request){
        return $this->commentService->reply($request);
    }

    public function deleteReply(Request $request){
        
    }

    public function delete($id){
        return $this->commentService->delete($id);    
    }
}
