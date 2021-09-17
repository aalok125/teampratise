<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use softDeletes;
    protected fillable[
        'post_title','post_slug','post_status','is_punlished','post_content','user_id',
    ];

    public function user (){
        return $this->belongsTo (Post::class);
    }
}
