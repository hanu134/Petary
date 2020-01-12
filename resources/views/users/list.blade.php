@extends("layouts.page")
    
@section("content")
        <header class="fixed-top mb-3">
            <nav class="navbar bg-light p-3">
                <i class="far fa-hand-point-left fa-2x icon"></i>
            </nav>
        </header>
    <h2 class="text-center mb-3 h2">ユーザ一覧</h2>
    @include("users.users", ["users" => $users])
@endsection