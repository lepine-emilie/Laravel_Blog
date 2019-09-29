@extends('layouts/app')
@section('title', 'Show Post')
@section('stylesheet')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            {{--            <div class="card-deck">--}}

            @forelse($posts as $post)
                <div class="card border-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('show_single', ['post'=> $post['id']])}}">{{$post['title']}}</a></h5>
                        <p class="card-text">{!! BBCode::convertToHtml(e($post->content)) !!}</p>
                        <p class="card-text"><small class="text-muted">By <a href="{{route('show_post_',['username' => $post['username']])}}">{{$post['username']}}</a>  Last updated {{$post['updated_at']}}
                        {{$post['comment_count']}}
                        @if($post['comment_count']== "1")
                        comment</small></p>
                        @else
                        comments</small></p>
                        @endif
                            <div class="edit_delete">
                                @can('delete', $post)
                                <form method="post" action="{{route('delete_post', ['post'=>$post->id])}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-secondary btn-sm" value="Delete">
                                </form>
                                @endcan
                                @can('update', $post)
                                <a href="{{route('edit_post',['post' => $post['id']])}}" ><button type="button" class="btn btn-secondary btn-sm">Edit</button></a>
                                @endcan
                            </div>
                    </div>
                </div>
            @empty
                <p>There are no posts!</p>
            @endforelse
            {{--            </div>--}}
        </div>
        {{$posts->links()}}
    </div>
@endsection
