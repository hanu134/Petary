@extends("layouts.page")
    
@section("content")
        <header class="fixed-top mb-3">
            <nav class="navbar bg-light p-3 justify-content-around">
                <a href="{{ route('followers.back', ["id" => $user->id]) }}"><i class="far fa-hand-point-left fa-2x icon"></i></a>
                <div></div>
                <div></div>
            </nav>
        </header>
        
        <div class="row justify-content-center">
        <div class="col-md-9 col-12">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route("users.followings", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users/" . $user->id . "/followings") ? "active" : "" }}">フォロー </a></li>
                
                <li class="nav-item"><a href="{{ route("users.followers", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users/" . $user->id . "/followers") ? "active" : "" }}">フォロワー </a></li>
            </ul>
        </div>
        </div>
    @include("users.users", ["users" => $users])
@endsection