<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li class="media mb-3 border rounded p-2 shadow">
            <i class="fas fa-paw fa-lg mr-2"></i>
            <div class="media-body">
                <div>
                    {!! link_to_route('users.index', $post->user->name, ['id' => $post->user->id]) !!} <span class="text-muted">{{ $post->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
                    
                    <div class="d-flex justify-content-around flex-wrap">
                        @foreach ($post->items as $item)
                        <p><img src="{{ asset('/storage/img/'.$item->path) }}"></p>
                        @endforeach
                    </div>
                </div>
                <div>
                    @if (Auth::id() == $post->user_id)
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm float-right']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>