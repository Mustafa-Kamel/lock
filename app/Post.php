<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'title', 'slug', 'body', 'img'
    ];
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function commnets(){
        return $this->hasMany(Comment::class);
    }
    
    public function getRouteKeyName(){
        return 'slug';
    }
    
    public static function uniqueSlug(){
        if(request('slug'))
            $slug = str_slug(request('slug'));
        else
            $slug = str_slug(request('title'));
        
        $count = Post::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        $newSlug = $count? substr("{$slug}-{$count}", 0, 255) : substr($slug, 0, 255);
        
        $count = Post::whereRaw("slug RLIKE '^{$newSlug}(-[0-9]+)?$'")->count();
        return $count? substr("{$newSlug}-{$count}", 0, 255) : substr($newSlug, 0, 255);
    }

}
