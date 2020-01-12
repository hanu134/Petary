<div class="modal fade" id="modal2" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label1">コメントを残す</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            {!! Form::open(["route" => ["comments.store", $post->id]]) !!}
        <div class="form-group text-center">
                {!! Form::textarea("comment", old("comment"), ["class" => "form-control", "rows" => "2"]) !!}
                {!! Form::hidden('post_id',$post->id) !!}
        </div>
      <div class="modal-footer">
        {!! Form::submit("送信", ["class" => "btn btn-primary"]) !!}
      </div>            
            
        {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>