@extends("layouts.app")
@section("content")
    <div class="text-center">
        <div class="d-inline-flex flex-column">
            <button type="button" class="btn btn-info mt-2">ログイン</button>
            {!! link_to_route("signup.get", "新規アカウント作成", [], ["class" => "btn btn-info mt-3"]) !!}
        </div>
    </div>
@endsection