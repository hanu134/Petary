<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, "user_follow", "user_id", "follow_id")->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, "user_follow", "follow_id", "user_id")->withTimestamps();
    }
    
    public function follow($userId)
    {
        // フォローしていないか確認
        $exist = $this->is_following($userId);
        // 自分ではないか確認
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            // フォロー済みの場合は何もしない
            return false;
        } else {
            // 未フォローの場合はフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // フォローしていないか確認
        $exist = $this->is_following($userId);
        // 自分ではないか確認
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            // フォロー済みの場合はフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローの場合は何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where("follow_id", $userId)->exists();
    }
    
    public function feed_posts()
    {
        $follow_user_ids = $this->followings()->pluck("users.id")->toArray();
        $follow_user_ids[] = $this->id;
        return Post::whereIn("user_id", $follow_user_ids);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Post::class,"favorites", "user_id", "post_id")->withTimestamps();
        //return $this->hasMany(Favorite::class);
    }
    
    public function is_favorite($postId)
    {
        return $this->favorites()->where("post_id", $postId)->exists();
    }
    
    public function favorite($postId)
    {
        $exist = $this->is_favorite($postId);
        
        if ($exist) {
            return false;
        } else {
            //$this->favorites()->attach($postId);
            Favorite::create(
                [
                    "user_id" => $this->id,
                    "post_id" => $postId
                ]
            );
            return true;
        }
    }
    
    public function unfavorite($postId)
    {
        $exist = $this->is_favorite($postId);
        
        if ($exist) {
            //$this->favorites()->detach($postId);
            $post = Post::findOrFail($postId);
            $post->favorite_by()->delete();
            
            return true;
        } else {
            return false;
        }
    }

}