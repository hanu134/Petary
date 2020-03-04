<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Post;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            "comment" => "required",
            ]);
        
        $post_id = $request->post_id;
        
        Comment::create([
            "user_id" => $request->user()->id,
            "post_id" => $request->post_id,
            "comment" => $request->comment,
            ]);
        
        return redirect("posts/{$post_id}")->with("flash_message", "送信しました");
    }
    
    public function show($post_id)
    {
        $post = Post::find($post_id);
        $user = User::where("id", $post->user_id)->first();
        
        return back();
    }
    
    public function destroy($id)
    {
        $comment = \App\Comment::find($id);
        
        if (\Auth::id() === $comment->user_id) {
            $comment->delete();
        }
        return back();
    }
}
