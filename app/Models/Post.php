<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;


class Post extends Model
{
   use softDeletes;
    protected $fillable = [
        'post_title','post_slug','post_status','is_published','post_content','user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
