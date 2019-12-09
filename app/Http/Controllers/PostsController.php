<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostsRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{
    public function index()
    {
        dd("index");
        
        $posts = Post::all();
        
        return view("posts.index", compact("posts"));
    }
    
    /**
     * 投稿データを保存する 
     */
    public function create(PostsRequest $request)
    {

    }
    
    public function store(Request $request)
    {
        
        /**
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);
        

        $request->user()->posts()->create([
            'content' => $request->content,
        ]);
        */
        
        if ($request->isMethod("POST")) {
            
            $post = Post::create(["content"=> $request->content, "user_id"=> \Auth::id()]);
        
            
            //投稿画像を保存する。（最大4ファイル）
            
            foreach ($request->file("files") as $index=> $e) {
                $ext = $e->guessExtension();
                $filename = time()."_{$index}.{$ext}";
                // Intervention Imageを使ってイメージ加工
                $img = Image::make($e);
                // アップロードした画像が回転して表示されるのを解決
                $img->orientate();
                // イメージリサイズ。横幅を指定。高さは自動調整
                $width = 250;
                $img->resize($width, null, function($constraint){
                                $constraint->aspectRatio();
                        });
                $path = "/post/photos/" . $filename;
                $img->save(public_path() . $path);
                
                $post->items()->create(["path"=> $path]);
            }
            
            return back()->with(["flash_message"=> "投稿しました"]);
        } 
        
        return back();
        
    }
    
    public function destroy($id)
    {
        $post = \App\Post::find($id);

        if (\Auth::id() === $post->user_id) {
            $post->delete();
            
        }

        return back();
    }
}
