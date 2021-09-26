<?php

namespace App\Repository;
use App\Models\PostImage;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
 

class fileUpload{
    public function imageUpload($image, $id, $request){
        $supportExt = array  ('jpg','png','gif','webp');
        $year = Carbon::now()->year;
        $month = Carbon::now()->month; 
        $thumbnailPath ='public/storage/upload/'.$year.'/'.$month.'/'; 
        //dd($thumbnailPath);
        if (!File::exists( $thumbnailPath)){
            File::makeDirectory( $thumbnailPath,0777,true,true);
        }
        $originalImage= $image;
        $imageExt = strtolower($originalImage->getClientOriginalExtension());
        $imageSize = filesize($originalImage);
        $imageType = "image"; //Using Manual way to define file type for image

        if(in_array($imageExt, $supportExt)){
            $thumbnailImage = \Image::make($originalImage);
            $thumbnailImage->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });  
        }
        else{
             $thumbnailImage =  $originalImage;
        }
        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 
        if (!$request->isMethod('post')) {
            $postImage = PostImage::where('post_id', $id)->first();
            $filePath = $postImage->path.'/'.$postImage->name;
            if(File::exists($filePath)) {
               unlink($filePath); 
            }
            $postImage->name = time().$originalImage->getClientOriginalName();
            $postImage->type =  $imageType;
            $postImage->ext =  $imageExt;
            $postImage->size =  $imageSize;
            $postImage->post_id = $id;
            $postImage->path =  $thumbnailPath;

            $postImage->save();
        }
        else{        
            $postImage= new PostImage();
            $postImage->post_id = $id;
            $postImage->name = time().$originalImage->getClientOriginalName();
            $postImage->type =  $imageType;
            $postImage->ext = $imageExt;
            $postImage->size = $imageSize;
            $postImage->path = $thumbnailPath;
            $postImage->save();
        }
        
    }
    public function imageDelete($id){
        $postImage = PostImage::where('post_id', $id)->first();
        if (!$postImage->path == Null){
            
            $filePath = $postImage->path.'/'.$postImage->name;
            if(File::exists($filePath)) {
            unlink($filePath); 
            }
        }
        else
        {
            $success = true;
            $message = "Post deleted successfully";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        
        }
    }
}


// $watermark= \Image::make(storage_path('app/public/backend/posts/thumbnail/watermark.jpg'));
        // $watermark->resize(25, 25, function ($constraint) {
        //     $constraint->aspectRatio();
        // });
        // $thumbnailImage->insert($watermark, 'center');

        // $thumbnailImage->text(' All Rights Reserved', 120, 100, function($font) { 
        //     $font->size(35);  
        //     $font->color('#ff4500');  
        //     $font->align('center');  
        //     $font->valign('bottom');  
        //     $font->angle(90);  
        // }); for Text WaterMark
        // $thumbnailImage->resizeCanvas( $height, null, 'center', false, 'ff4500'); //For Canvas