@extends("layouts.page")

@section("content")
    <div class="row">
        <header class="fixed-top mb-3">
            <nav class="navbar bg-light p-3 justify-content-around">
                <a href="http://2165fca39035409d8d52b5e54b0de824.vfs.cloud9.us-east-1.amazonaws.com/logout"><i class="fas fa-sign-out-alt fa-flip-horizontal fa-2x icon"></i></a>
                <span class="navbar-text username">{{ $user->name }}</span>
                <i class="fas fa-edit fa-2x icon"></i>
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
        <div class="col-10">

            {!! Form::open(["action" => "PostsController@store", "method" => "POST", "enctype" => "multipart/form-data"]) !!}
                <div class="form-group text-center">
                    {!! Form::textarea("content", old("content"), ["class" => "form-control", "rows" => "2"]) !!}
                    {{Form::file("files[]")}}
                    {{Form::file("files[]")}}<br>
                    {{Form::file("files[]")}}
                    {{Form::file("files[]")}}
                    {!! Form::submit("投稿", ["class" => "btn btn-primary btn-block mb-5"]) !!}
                </div>
            {!! Form::close() !!}
        </div>  
        
        <div class="w-100"></div>

        <p><i class="fas fa-paw paw border border-dark rounded-circle p-2"></i></p>
        <div class="w-100"></div>
        <h4 class="mb-5">{{ $user->name }}</h4>
        <div class="w-100"></div>
            
    </div>
            
    <div class="row justify-content-center mb-5">
        <button type="button" class="btn btn-info mr-5">フォロー　 <span class="badge badge-light badge-pill">32</span></button>
        <button type="button" class="btn btn-info ml-5">フォロワー <span class="badge badge-light badge-pill">21</span></button>
    </div>
            
        
    <div class="row justify-content-center">
        <div class="w-100"></div>

        
        <div class="col-md-9 col-12">    
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route("users.index", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users") ? "active" : "" }}">投稿 <span class="badge badge-secondary">{{ $count_posts }}</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link {{ Request::is("users/*/favorites") ? "active" : "" }}">お気に入り <span class="badge badge-secondary">32</span></a></li>
            </ul>
        </div>
        
        
        
        <div class="col-md-8 col-12">
            @if (count($posts) > 0)
                @include("posts.posts", ["posts" => $posts])
            @endif
        </div>
    </div>
@endsection
