<?php

namespace App\Http\Controllers;



use App\Comment;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Shows right page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new(){
        return view('posts.new');
    }

    /**
     * Creates a new post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(){
        $data = request()->validate([
            'title' => ['required'],
            'content' => ['required'],
            'tags' => ['required'],
        ]);
        $data['user_id']= Auth::user()->id;
        \App\Post::create($data);
        return Redirect::to('/post/show');
    }

    /**
     * Shows all the posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){

        $posts = \App\Post::with("user")->withCount("comment")->orderby('id', 'desc')->paginate(5);
        foreach($posts as $post) {
            $post['username'] = User::find(
                $post['user_id'])->username;
        }
        return view('posts.show', compact('posts'));
    }

    /**
     * Shows posts by specific user
     *
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showbyusername($username){

        $posts = \App\Post::whereHas("user", function ($query) use ($username) {
            $query->where("username", $username);
        })->paginate(5);
        foreach($posts as $post) {
            $post['username'] = User::find(
                $post['user_id'])->username;
        }
        return view('posts.show', compact('posts'));
    }

    /**
     * Delete a post
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function delete_post(Post $post){
        $this->authorize("delete", $post);
        $post->delete();
        return redirect()->route("show_post");
    }

    /**
     * Show edit form
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_post(Post $post){
        return view('posts.edit', compact('post'));
    }

    /**
     * Submit edits for posts
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update_post(PostUpdateRequest $request, Post $post){
        $this->authorize("update", $post);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->tags = $request->tags;
        $post->save();
        return redirect()->route("show_post");
    }

    /**
     * show only one post
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_single(Post $post){
        $posts = \App\Post::where('id', $post->id)->paginate(1);
        foreach($posts as $post) {
            $post['username'] = User::find(
                $post['user_id'])->username;
        }
        $comments = Comment::where('post_id', $post->id)->get();
        foreach ($comments as $comment){
            $comment['username'] = User::find($comment['user_id'])->username;
        }
        return view('posts.show_single', compact('posts', 'comments'));
    }

}
