@extends('layouts/app')
@section('title', 'Edit Comment')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit your comment') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('comments.update', ['comment'=> $comment]) }}">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                                <div class="col-md-6">
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content" autofocus>{{$comment['content']}}</textarea>
                                    <input type="submit" class="btn btn-secondary btn-sm" value="Update your comment">
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection