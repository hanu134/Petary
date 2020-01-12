@extends("layouts.page")

@section("content")
    <div class="row">
        <header class="fixed-top mb-3">
            <nav class="navbar bg-light p-3 justify-content-around">
                
                <a href="{{ route('logout.get')}}"><i class="fas fa-sign-out-alt fa-flip-horizontal fa-2x icon"></i></a>
                
                <h2 class="username">{{ $user->name }}</h2>
                
                <a href="{{ route('ranking.user') }}"><i class="fas fa-crown fa-2x icon"></i></a>
                
            </nav>
        </header>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $erroe)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    
    <div class="row justify-content-center">
        
        <div class="w-100"></div>

        <p><i class="fas fa-paw paw border border-dark rounded-circle p-2"></i></p>
        <div class="w-100"></div>
        <h4>{{ $user->name }}</h4>
        <div class="w-100"></div>
        <div class="mb-5">@include("user_follow.follow_button", ["user" => $user])</div>
            
    </div>
            
    <div class="row justify-content-center mb-5">
        <a href="{{ route("users.followings", ["id" => $user->id]) }}" class="btn btn-info mr-5">フォロー　<span class="badge badge-light badge-pill">{{ $count_followings }}</span></a>
        
        <a href="{{ route("users.followers", ["id" => $user->id]) }}" class="btn btn-info ml-5">フォロワー <span class="badge badge-light badge-pill">{{ $count_followers }}</span></a>
    </div>
            
        
    <div class="row justify-content-center">
        <div class="w-100"></div>

        
        <div class="col-md-9 col-12">    
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route("users.show", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users") ? "active" : "" }}">投稿 <span class="badge badge-secondary">{{ $count_posts }}</span></a></li>
                
                <li class="nav-item"><a href="{{ route("users.favorites", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users/*/favorites") ? "active" : "" }}">お気に入り <span class="badge badge-secondary">{{ $count_favorites }}</span></a></li>
            </ul>
        </div>
        
        
        
        <div class="col-md-8 col-12">
            @if (count($posts) > 0)
                @include("posts.posts", ["posts" => $posts])
            @endif
        </div>
    </div>
@endsection
