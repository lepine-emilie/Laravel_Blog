@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        Latest Users
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($users as $user)
                            <li class="list-group-item"><a href="{{route('show_post_',['username' => $user['username']])}}">{{$user['username']}}</a></li>
                        @empty
                            <p>There are no users</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Latest posts
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($posts as $post)
                            <div class="card border-dark mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{route('show_single', ['post'=> $post['id']])}}">{{$post['title']}}</a></h5>
                                    <p class="card-text">{{$post['content']}}</p>
                                    <p class="card-text"><small class="text-muted">By <a href="{{route('show_post_',['username' => $post['username']])}}">{{$post['username']}}</a>  Last updated {{$post['updated_at']}}</small></p>
                                </div>
                            </div>
                        @empty
                            <p>There are no posts!</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        Latest Comments
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($comments as $comment)
                            <div class="card border-dark mb-3" style="max-width: 18rem;">
                                <div class="card-body text-dark">
                                    <p class="card-text">{{$comment['content']}}</p>
                                </div>
                                <div class="card-footer bg-transparent border-dark">By <a href="{{route('show_post_',['username' => $comment['username']])}}">{{$comment['username']}}</a></div>
                            </div>
                        @empty
                            <p>There are no comments</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
