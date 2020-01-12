@extends("layouts.page")
    
@section("content")
        <header class="fixed-top mb-3">
            <nav class="navbar bg-light p-3">
                <a href="#" onclick="window.history.back(); return false;"><i class="far fa-hand-point-left fa-2x icon"></i></a>
            </nav>
        </header>
        
        <div class="row justify-content-center">
        <div class="col-md-9 col-12">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route("ranking.user") }}" class="nav-link {{ Request::is("ranking/user") ? "active" : "" }}">人気のユーザー </a></li>
                
                <li class="nav-item"><a href="{{ route("ranking.post") }}" class="nav-link {{ Request::is("ranking/post") ? "active" : "" }}">人気の投稿 </a></li>
            </ul>
        </div>
        </div>
        
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
            @if (count($posts) > 0)
                @include("posts.posts", ["posts" => $posts])
            @endif
        </div>
    </div>
@endsection