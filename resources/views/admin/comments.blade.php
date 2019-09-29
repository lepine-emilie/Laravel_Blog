@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                @forelse($comments as $comment)
                    <div class="card text-center">
                        <div class="card-body">
                            <p class="card-text">{{$comment['content']}}</p>
                            <div class="card-footer bg-transparent border-dark">By <a href="{{route('show_post_',['username' => $comment['username']])}}">{{$comment['username']}}</a></div>
                        </div>
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
                    </div>
                @empty
                    <p>There are no comments</p>

                @endforelse
            </div>
            {{ $comments->links() }}
        </div>
    </div>
@endsection
