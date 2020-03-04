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

    }

    public function create(PostsRequest $request)
    {

    }
        
    /**
     * 投稿データを保存する 
     */
    public function store(Request $request)
    {
        if ($request->isMethod("POST")) {
            $this->validate($request,[
                "content" => "required",
                "files" => "required",
            ]);
            
            $post = Post::create(["content"=> $request->content, "user_id"=> \Auth::id()]);
            

            $time = time();
            
            //投稿画像を保存する。（最大4ファイル）
            
            foreach ($request->file("files") as $index=> $image_file) {
                
                // $path = $image_file->store("public/img");
                

                // Intervention Imageを使ってイメージ加工
                $img = Image::make($image_file);
                // アップロードした画像が回転して表示されるのを解決
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
                Storage::disk("s3")->put($path, $img->encode());
                
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
        
        // sessionからリダイレクト先を取得(タイムライン・投稿・お気に入り)
        return redirect(session("backUrl"));
    }
    
    public function show($id)
    {
        $post = Post::find($id);
        return view("posts.detail")->with("post", $post);
    }
    
    public function postrank()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $posts = Post::where("favorites_count", ">", "0")->orderBy("favorites_count", "desc")->paginate(20);
        
            $data = [
                "user" => $user,
                "posts" => $posts,
            ];
        }
        
        // 投稿を削除した後のリダイレクト先をsessionに保存
        session(["backUrl" => request()->path()]);
        
        return view("ranking.post", $data);
    }
}
