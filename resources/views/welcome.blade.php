@extends("layouts.app")
@section("content")
    @if (Auth::check())
        <div class="text-center">
            <div class="d-inline-flex flex-column">
                {!! link_to_route("logout.get", "ログアウト", [], ["class" => "btn btn-info mt-2"]) !!}
            </div>
        </div>
    @else
        <div class="text-center">
            <div class="d-inline-flex flex-column">
                {!! link_to_route("login", "ログイン", [], ["class" => "btn btn-info mt-2"]) !!}
                {!! link_to_route("signup.get", "新規アカウント作成", [], ["class" => "btn btn-info mt-3"]) !!}
            </div>
        </div>
    @endif
@endsection