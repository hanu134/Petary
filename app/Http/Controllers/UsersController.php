<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Post;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->action(
            "UsersController@show", ["id" => \Auth::id()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        
        if (\Auth::check()) {
            $user = User::find($id);
            $posts = $user->posts()->orderBy("created_at", "desc")->paginate(100);
            
            $data = [
                "user" => $user,
                "posts" => $posts,
            ];
            
            $data += $this->counts($user);
        }
        
        // 投稿を削除した後のリダイレクト先をsessionに保存
        session(["backUrl" => request()->path()]);
        
        return view("users.index", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list()
    {
        $users = User::orderBy("id", "desc")->paginate(100);
        
        return view("users.list", [
            "users" => $users,
        ]);
    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(100);
        
        $data = [
            "user" => $user,
            "users" => $followings,
        ];
        
        $data += $this->counts($user);
        
        return view("users.followings", $data);
    }
    
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(100);
        
        $data = [
            "user" => $user,
            "users" => $followers,
        ];
        
        $data += $this->counts($user);
        
        return view("users.followers", $data);
    }
    
    public function timeline()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $posts = $user->feed_posts()->orderBy("created_at", "desc")->paginate(100);
        
            $data = [
                "user" => $user,
                "posts" => $posts,
            ];
        }
        
        // 投稿を削除した後のリダイレクト先をsessionに保存
        session(["backUrl" => request()->path()]);
        
        return view("users.timeline", $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(100);
        
        $data = [
            "user" => $user,
            "posts" => $favorites,
        ];
        
        $data += $this->counts($user);
        
        // 投稿を削除した後のリダイレクト先をsessionに保存
        session(["backUrl" => request()->path()]);
        
        return view("users.favorites", $data);
    }
    
    public function userrank()
    {
        $users = User::withCount("followers")->orderBy("followers_count", "desc")->paginate(100);
        
        
        return view("ranking.user", [
            "users" => $users,
        ]);
    }
}

