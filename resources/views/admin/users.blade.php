@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card text-center col-6">
                <div class="card-header">
                 Users
                </div>
                <ul class="list-group list-group-flush col-12">
                    @forelse($users as $user)
                        <li class="list-group-item"><a href="{{route('show_post_',['username' => $user['username']])}}">{{$user['username']}}</a>
                            <h6>Account</h6>
                            @if($user['active'] === 1)
                                <form method="post" action="{{route('users.deactivate', ['user'=>$user->id])}}">
                                    @csrf
                                    @method('put')
                                    <input type="submit" class="btn btn-secondary btn-sm" value="deactivate">
                                </form>
                        </li>
                            @else
                                <form method="post" action="{{route('users.activate', ['user'=>$user->id])}}">
                                    @csrf
                                    @method('put')
                                    <input type="submit" class="btn btn-secondary btn-sm" value="activate">
                                </form>
                        </li>
                            @endif
                            <form method="post" action="{{route('users.role', ['user'=>$user->id])}}">
                                @csrf
                                @method('put')
                                <select name="role">
                                    <option value=""></option>
                                    <option value="2">Blog</option>
                                    <option value="3">Comment</option>
                                    <option value="1">Admin</option>
                                </select>
                                <input type="submit" class="btn btn-secondary btn-sm" value="Add Role">
                            </form>
                    @empty
                        <p>There are no users</p>
                    @endforelse
                </ul>
            </div>
        </div>
        <br>
        {{ $users->links() }}
    </div>
@endsection
