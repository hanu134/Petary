<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ["post_id", "path"];
    
    public function post()
    {
        return $this->belongsTo("App\Post");
    }
}
