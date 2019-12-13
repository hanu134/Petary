<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Storage;
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
        if ($request->isMethod("POST")) {
            
            $post = Post::create(["content"=> $request->content, "user_id"=> \Auth::id()]);
            $time = time();
            
            //投稿画像を保存する。（最大4ファイル）
            
            foreach ($request->file("files") as $index=> $image_file) {
                
                // $path = $image_file->store("public/img");
                

                  // Intervention Imageを使ってイメージ加工
                $img = Image::make($image_file);
                //  // アップロードした画像が回転して表示されるのを解決
                $img->orientate();
                  // イメージリサイズ。横幅を指定。高さは自動調整
                $width = 250;
                $img->resize($width, null, function($constraint){
                                $constraint->aspectRatio();
                          });
                
                // $img->save(public_path() . $path);
                $ext = $image_file->guessExtension();
                $filename = $time."_{$index}.{$ext}";  
                $path = "img/" . $filename;
                Storage::disk("public")->put($path, $img->encode());
                
                $post->items()->create(["path"=> basename($path)]);
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
