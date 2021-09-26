<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\PostImage;
use Storage;
use File;


class Post extends Model
{
   use softDeletes;
    protected $fillable = [
        'post_title','post_slug','post_status','is_published','post_content','user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postImage (){
        return $this->hasOne(PostImage::class);
    }
    public function getThumbnail(){
        if( $this->postImage == Null){
            return Storage::disk('postThumbnail')->url('no_image150.gif');
        }
        else{
            $imageName = $this->postImage->name;
            $imagePath =  $this->postImage->path.$imageName;
            if(File::exists($imagePath))
            {
                return ($imagePath);
            }
            else
            {
                return Storage::disk('postThumbnail')->url('no_image150.gif');
            }
        }
       
        // $thumbnailPath = "/storage/backend/posts/thumbnail/";
        // return $thumbnailPath;
        
    }
}
