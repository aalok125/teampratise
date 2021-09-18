<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   /*use SoftDeletes();*/
    protected $fillable = [
        'post_title','post_slug','post_status','is_published','post_content','user_id'
    ];

    public function user(){
        return $this->belongsTo(Post::class);
    }
}
