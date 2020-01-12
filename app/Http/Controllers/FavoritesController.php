<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Favorite;
use Auth;
use App\Post;

class FavoritesController extends Controller
{
   public function store(Request $request, $postId)
    {
        \Auth::user()->favorite($postId);
        return back();
    }
    
    public function destroy($postId)
    {
        \Auth::user()->unfavorite($postId);
        return back();
    }
    

}
