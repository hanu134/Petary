<ul class="list-unstyled">
    @foreach ($posts as $post)
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
                            </button>
                            {{ $post->favorites_count }}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(["route" => ["favorites.favorite", $post->id]]) !!}
                            <button type="submit" class="btn" onfocus="this.blur();">
                                <i class="far fa-star post faa-shake animated-hover"></i>
                            </button>
                            {{ $post->favorites_count }}
                        {!! Form::close() !!}
                    @endif
                        <a href="#" type="button" data-toggle="modal" data-target="#modal2">
                            <i class="far fa-comment mt-2 comment"></i>
                        </a>
                    @include("comments.comment")
                    
                    {{ link_to("/posts/{$post->id}", '詳細', array('class' => 'btn')) }}
                    
                    @if (Auth::id() == $post->user_id)
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                            <button type="submit" class="btn" onfocus="this.blur();">
                                <i class="far fa-trash-alt post"></i>
                            </button>
                            {{-- {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm float-right']) !!} --}}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>