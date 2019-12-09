@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(["route" => "login.post"]) !!}
                <div class="form-group">
                    {!! Form::email("email", old("email"), ["class" => "mt-3 form-control", "placeholder" => "メールアドレス"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::password("password", ["class" => "form-control", "placeholder" => "パスワード"]) !!}
                </div>
                
                <div class="text-center mb-4">
                {!! Form::submit("ログイン", ["class" => "btn btn-info pr-5 pl-5"]) !!}
                </div>
            {!! Form::close() !!}
            
            <div class="border-top text-center">
                <div class="text-muted mt-4">
                    アカウントをお持ちでない場合
                </div>
                {!! link_to_route("signup.get", "アカウント作成") !!}
            </div>
        </div>
    </div>
@endsection
