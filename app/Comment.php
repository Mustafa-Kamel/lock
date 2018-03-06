<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'img'
    ];
    
    public function user(){
        return $this->belongsTo(App\User::class);
    }
    
    public function post(){
        return $this->belongsTo(App\Post::class);
    }
}
