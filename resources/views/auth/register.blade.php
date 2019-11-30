@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <div class="card overflow-auto mb-4">
                <div class="card-header text-center text-muted"><h5>利用規約</h5></div>
                <div class="card-body">
                    ...
                </div>
            </div>
            
            {!! Form::open(["route" => "signup.post"]) !!}
                <div class="border-top form-group">
                    {!! Form::text("name", old("name"), ["class" => "mt-4 form-control", "placeholder" => "ユーザーネーム"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::email("email", old("email"), ["class" => "mt-3 form-control", "placeholder" => "メールアドレス"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::password("pasword", ["class" => "form-control", "placeholder" => "パスワード"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::password("pasword_confirmation", ["class" => "form-control", "placeholder" => "パスワード確認"]) !!}
                </div>
                
                <div class="text-center">
                {!! Form::submit("作成", ["class" => "btn btn-info pr-5 pl-5"]) !!}
                </div>
                
                <div class="text-center text-muted mr-5 ml-5 mb-4">
                    <small>アカウントを作成することで、Petaryの利用規約に同意するものとします。</small>
                </div>
            {!! Form::close() !!}
            
            <div class="border-top text-center">
                <div class="text-muted mt-4">
                    既にアカウントをお持ちの場合
                </div>
                <a href="#">ログイン</a>
            </div>
        </div>
    </div>
    
@endsection