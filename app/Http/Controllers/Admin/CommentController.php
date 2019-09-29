<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::paginate(15);
        foreach($comments as $comment) {
            $comment['username'] = User::find(
                $comment['user_id'])->username;
        }
        return view('admin.comments', compact('comments'));
    }

}
