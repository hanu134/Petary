<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;

class Favorite extends Model
{
    use CounterCache;
    
    public $counterCacheOptions = [
        "Post" => [
            "field" => "favorites_count",
            "foreignKey" => "post_id"
        ]    
    ];
    
    protected $fillable = ["user_id", "post_id"];
    
    public function Post()
    {
        return $this->belongsTo("App\Post");
    }
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
