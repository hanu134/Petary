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
        
@if (count($users) > 0)
    <div class="row d-block justify-content-center">
        
    <div class="col-sm-5 mx-auto">
      
        <ul class="list-inline">
            @foreach ($users as $user)
            <li class="media border rounded p-3 shadow m-2">
            <i class="fas fa-paw fa-lg fa-2x mr-2"></i>
                <div class="media-body">
                    <div>
                        <h5 class="mb-0 pl-2 ">{!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!}</h5>
                    </div>
                    <div>
                    </div>
                    <div class="text-right">
                        @include("user_follow.follow_button", ["user" => $user])
                    </div>
                </div>
            </li> 
            @endforeach
        </ul>
    </div>      
        
    </div>
@endif
@endsection