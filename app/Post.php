<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["content", "user_id"];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function items()
    {
        return $this->hasMany("App\Item");
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function comment_by()
    {
        return Favorite::where("post_id", $this->id)->where("user_id", \Auth::user()->id)->first();
    }

    public function favorites()
    {
        return $this->hasMany("App\Favorite");
    }
    
    public function favorite_by()
    {
        return Favorite::where("post_id", $this->id)->where("user_id", \Auth::user()->id)->first();
    }
}
