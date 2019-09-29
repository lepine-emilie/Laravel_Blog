<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $users = User::latest()->limit(10)->get();
        $comments = Comment::latest()->limit(10)->get();
        $posts = Post::latest()->limit(10)->get();
        foreach($posts as $post) {
            $post['username'] = User::find(
                $post['user_id'])->username;
        }
        foreach($comments as $comment) {
            $comment['username'] = User::find(
                $comment['user_id'])->username;
        }
        return view('admin.index', compact('users', 'posts', 'comments'));
    }
}
