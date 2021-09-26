<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class PostImage extends Model
{
    protected $fillables = [
        'name','type','ext','size','post_id','path',
    ];

    public function post(){
        return  $this->belongsTo(Post::class);
    }
}
