<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(){

        $posts = Post::with("user")->withCount("comment")->orderby('id', 'desc')->paginate(5);
        foreach($posts as $post) {
            $post['username'] = User::find(
                $post['user_id'])->username;
        }
        return view('posts.show', compact('posts'));
    }
}
