@extends("layouts.page")

<header class="fixed-top mb-3">
    <nav class="navbar navbar-expand navbar-light bg-light p-3">
        <a href="http://2165fca39035409d8d52b5e54b0de824.vfs.cloud9.us-east-1.amazonaws.com/logout"><i class="fas fa-sign-out-alt fa-flip-horizontal fa-2xicon"></i></a>
        <div class="row justify-content-center"><p>{{ $user->name }}</p></div>
    </nav>
</header>

@section("content")
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
            
            @if (count($posts) > 0)
                @include("posts.posts", ["posts" => $posts])
            @endif
        </div>
    </div>
@endsection
