@extends("layouts.page")

@section("content")
    <div class="row">
        <header class="fixed-top">
            <nav class="navbar bg-light justify-content-around">
                
                <a href="{{ route('logout.get')}}"><i class="fas fa-sign-out-alt fa-flip-horizontal fa-2x icon"></i></a>
                
                <nav class="navbar bg-light justify-content-around">
                    <h2 class="petary">Petary</h2>
                    </nav>
                
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
        <div class="col-md-8 col-12">
            @if (count($posts) > 0)
                @include("posts.posts", ["posts" => $posts])
            @endif
        </div>
    </div>
@endsection
