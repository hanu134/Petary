@extends("layouts.page")
    
@section("content")
<header class="fixed-top mb-3">
    <nav class="navbar bg-light p-3 justify-content-around">
        <a href="{{ route('detail.back', ['id' => $post->id]) }}"><i class="far fa-hand-point-left fa-2x icon"></i></a>
        <div></div>
        <div></div>
    </nav>
</header>


<div class="row justify-content-center">
    <div class="col-md-8 col-12">
        <ul class="list-unstyled">
            <li class="media mb-3 border rounded p-2 shadow">
            
                <div class="media-body">

                    <div>
                        <i class="fas fa-paw fa-lg"></i>
                        {!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id]) !!} <span class="text-muted">{{ $post->created_at }}</span>
                        
                    </div>
                    <div class="border-top mt-2">
                        <p class="ml-4 my-2">{!! nl2br(e($post->content)) !!}</p>
                    
                        <div class="d-flex justify-content-around flex-wrap">
                            @foreach ($post->items as $item)
                            <p><img src="{{ Storage::disk('s3')->url('img/'.$item->path) }}"></p>
                            @endforeach
                        </div>
                    </div>
                    <div class="my-2 border-top"></div>
                    <div class="d-flex row justify-content-around">
                        @if (Auth::user()->is_favorite($post->id))
                            {!! Form::open(["route" => ["favorites.unfavorite", $post->id], "method" => "delete"]) !!}
                                <button type="submit" class="btn" onfocus="this.blur();">
                                    <span class="fa-stack">
                                        <i class="far fa-star fa-stack-1x post"></i>
                                        <i class="fas fa-star fa-stack-1x star"></i>
                                    </span>
                                    {{ $post->favorites_count }}
                                </button>
                                
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(["route" => ["favorites.favorite", $post->id]]) !!}
                                <button type="submit" class="btn" onfocus="this.blur();">
                                    <i class="far fa-star post faa-shake animated-hover"></i>
                                    {{ $post->favorites_count }}
                                </button>
                                
                            {!! Form::close() !!}
                        @endif
                        
                        
                        <button type="button" class="btn" onfocus="this.blur();" data-toggle="modal" data-target="#modal2">
                            <i class="far fa-comment comment"></i>
                            <span>{{ $post->comments->count() }}</span>
                        </button>
                        @include("comments.comment")
                        
                    
                        @if (Auth::id() == $post->user_id)
                            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                                <button type="submit" class="btn" onfocus="this.blur();">
                                    <i class="far fa-trash-alt post"></i>
                                </button>
                                {{-- {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm float-right']) !!} --}}
                            {!! Form::close() !!}
                        @endif
                    </div>
                    
                    <div class="my-2 border-top"></div>
                    
                    <div class="d-flex row justify-content-around">
                        <h5>コメント一覧</h5>
                    </div>    
                    
                    
                        <ul class="list-unstyled">
                            @foreach ($post->comments as $comment)
                                <li class="media p-2 border mb-1">
                                    <div class="media-body">
                                        <div>
                                            <i class="fas fa-paw fa-lg"></i>
                                            {!! link_to_route('users.show', $comment->user->name, ['id' => $comment->user->id]) !!} <span class="text-muted">{{ $comment->created_at }}</span>
                                        </div>
                                        <div class="border-top mt-2">
                                            <p class="ml-4 my-2">{!! nl2br(e($comment->comment)) !!}</p>
                                        </div>
                                        @if (Auth::id() == $comment->user_id)
                                            {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm float-right']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                    
                    
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection