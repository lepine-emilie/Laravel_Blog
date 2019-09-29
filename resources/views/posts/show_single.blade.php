@extends('layouts/app')
@section('title', 'Show Post')
@section('stylesheet')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="card border-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('show_single', ['post'=> $post['id']])}}">{{$post['title']}}</a></h5>
                        <p class="card-text">{!! nl2br(BBCode::convertToHtml(e($post->content))) !!}</p>
                        <p class="card-text badge badge-dark"><small>Tags : {{$post->tags}}</small></p>
                        <p class="card-text"><small class="text-muted">By <a href="{{route('show_post_',['username' => $post->user->username])}}">{{$post->user->username}}</a>  Last updated {{$post['updated_at']}}</small></p>
                        <div class="edit_delete">
                            @can('delete', $post)
                                <form method="post" action="{{route('delete_post', ['post'=>$post->id])}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-secondary btn-sm" value="Delete">
                                    @endcan
                                    @can('update', $post)
                                        <a href="{{route('edit_post',['post' => $post['id']])}}" ><button type="button" class="btn btn-secondary btn-sm">Edit</button></a>
                                    @endcan
                                </form>
                        </div>
                        <p>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseComments" aria-expanded="false" aria-controls="collapseExample">
                                View comments
                            </button>
{{--                            @can('create', $comment)--}}
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseCommentAction" aria-expanded="false" aria-controls="collapseExample">
                                Comment
                            </button>
{{--                                @endcan--}}
                        </p>
                        <div class="collapse" id="collapseComments">
                            <div class="card" >
                                <ul class="list-group list-group-flush">
                                    @forelse($comments as $comment)
                                        <li class="list-group-item">{{$comment['content']}}
                                            <p class="card-text"><small class="text-muted">  By <a href="{{route('show_post_',['username' => $comment['username']])}}">{{$comment['username']}}</a>  Last updated {{$comment['updated_at']}}</small></p>
                                            @can('delete', $comment)
                                                <div class="edit_delete">
                                                    <form method="post" action="{{route('comments.destroy', ['comment'=>$comment->id])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="submit" class="btn btn-secondary btn-sm" value="Delete">
                                                        @endcan
                                                        @can('update', $comment)
                                                            <a href="{{route('comments.edit',['comment' => $comment['id']])}}" ><button type="button" class="btn btn-secondary btn-sm">Edit</button></a>
                                                    </form>
                                                </div>
                                            @endcan
                                        </li>
                                    @empty
                                        <p>There are no comments for this post</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseCommentAction">
                        <div class="card-footer text-muted">
                            @can('create', $comment)
                            <form method="post" action="{{route('comments.store')}}">
                                @csrf
                                <label for="content" class="col-md-4 col-form-label text-md-left">{{ __('Comment') }}</label>
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content" autofocus></textarea>
                                <br>
                                <input type="hidden" name="post_id" id="post_id" value="{{$post['id']}}">
                                <input type="submit" class="btn btn-secondary btn-sm" value="Submit Comment">

                            </form>
                                @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
