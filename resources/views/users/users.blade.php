@if (count($users) > 0)
    <div class="row d-block justify-content-center">
        
    <div class="col-sm-5 mx-auto">
      
        <ul class="list-inline">
            @foreach ($users as $user)
            <li class="media border rounded p-3 shadow m-2">
            <i class="fas fa-paw fa-lg fa-2x mr-2"></i>
                <div class="media-body">
                    <div>
                        <h5 class="mb-0 pl-2 ">{!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!}</h5>
                    </div>
                    <div class="text-right">
                        @include("user_follow.follow_button", ["user" => $user])
                    </div>
                </div>
            </li> 
            @endforeach
        </ul>
    </div>      
        
    </div>
@endif