<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $results = Post::where('content', 'like', '%'.$request->get('keyword').'%')
            ->orwhere('tags', 'like', '%'.$request->get('keyword').'%')
            ->withCount("comment")
            ->paginate(5);
        return view('search', compact('results'));
    }
}
