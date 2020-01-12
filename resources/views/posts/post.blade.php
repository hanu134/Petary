<div class="modal fade" id="modal1" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label1">Petary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            {!! Form::open(["action" => "PostsController@store", "method" => "POST", "enctype" => "multipart/form-data"]) !!}
        <div class="form-group text-center">
                {!! Form::textarea("content", old("content"), ["class" => "form-control", "rows" => "2"]) !!}
                {{Form::file("files[]")}}
                {{Form::file("files[]")}}<br>
                {{Form::file("files[]")}}
                {{Form::file("files[]")}}
                
            </div>
      <div class="modal-footer">
        {!! Form::submit("投稿", ["class" => "btn btn-primary"]) !!}
      </div>            
            
        {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>