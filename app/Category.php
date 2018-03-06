<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'img'
    ];
    

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
    
    public static function uniqueSlug(){
        if(request('slug'))
            $slug = str_slug(request('slug'));
        else
            $slug = str_slug(request('title'));
        
        $count = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        $newSlug = $count? substr("{$slug}-{$count}", 0, 255) : substr($slug, 0, 255);
        
        $count = Category::whereRaw("slug RLIKE '^{$newSlug}(-[0-9]+)?$'")->count();
        return $count? substr("{$newSlug}-{$count}", 0, 255) : substr($newSlug, 0, 255);
    }
}
