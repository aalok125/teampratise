<?php

namespace App\Http\Controllers;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use App\Models\PostImage;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Repository\FileUpload;
use App\GlobalService\ResponseService;


class PostController extends Controller
{
    public $responseService;
    public $fileUpload;

    public function __construct(FileUpload $fileUpload, ResponseService $responseService ){
        $this->fileUpload = $fileUpload;
        $this->responseService = $responseService;
    }
    public function index(){
        try{ 
            $posts = Post::with('postImage')->latest()->get();
            return view ('backend.posts.index',compact('posts'));
        }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }
       
    }

    public function show($id){
        try{
            $post = Post::with('postImage')->where('id',$id)->first();
            return view ('backend.posts.show',compact('post'));
        }catch (Exception $e){
             $this->responseService->responseBladeError($e->getMessage());
        }
       
    }

    public function create(){
        try {
            return view('backend.posts.create');
        }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }{

        }
        
    }

    public function store( PostStoreRequest $request){
        try {
            $post= new Post();
            $post->post_title = ucwords($request->get('post_title'));
            $post->post_slug = Str::slug($request->get('post_title'));
            $post->post_status = $request->get('status');
            $post->is_published = $request->get('is_published');
            $post->post_content = $request->get('post_content');
            $post->user_id = 1 ;
            $post->save();
            $this->fileUpload->imageUpload($request->name, $post->id, $request);
            Session::flash('success','Post Updated successfully');
            return redirect()->route('posts.index');

        }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }
        
    }
   
    public function edit($id){
        try {
            $post=Post::where('id', $id)->first();
            return view ('backend.posts.edit',compact ('post'));
        }catch (Exception $e){
            $this->responseService->responseBladeError($e->getMessage());
        } 
        
    }

    public function update(PostUpdateRequest $request, $id){
        try {
            $post=Post::where('id', $id)->first();
            $post->post_title = ucwords($request->get('post_title'));
            $post->post_slug = Str::slug($request->get('post_title'));
            $post->post_status = $request->get('post_status');
            $post->is_published = $request->get('is_published');
            $post->post_content = $request->get('post_content');
            $post->user_id = 1;
            $post->save();
            $this->fileUpload->imageUpload($request->name, $id, $request );
            Session::flash('success','Post Updated successfully');
            return redirect()->route('posts.index');    
        }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }        
    }
     

    public function destroy($id){
        try{
            Post::where('id',$id)->delete();
            $success = true;
            $message = "Post Deleted. Moved To Trash";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);                             
       }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }        
    }

    public function undoDelete($id){
        try {
            Post::withTrashed()
            ->where('id',$id)
            ->restore(); 
            Session::flash('success','Post Retrived. Moved To Index Page');
            return redirect()->route('posts.trash');
        }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }        
    }

    public function trashPost(){
        try {
            $trashPosts = Post::onlyTrashed()->get();
            return view('backend.posts.trash',compact('trashPosts'));
        }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }        
    }

    public function permanentDelete($id){
        try {
            $this->fileUpload->imageDelete($id); 
            $post = Post::onlyTrashed()
                ->where('id',$id)
                ->forceDelete();        
               
            $success = true;
            $message = "Post deleted successfully";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
            return redirect()->route('posts.trash');
        }catch (Exception $e){
              $this->responseService->responseBladeError($e->getMessage());
        }        
    }
    // public function imageUpload($image,  $id){
      
    //         $year = Carbon::now()->year;
    //         $month = Carbon::now()->month; 
    //         $thumbnailPath = public_path().'/storage/upload/'.$year.'/'.$month.'/'; 
    //         if (! File::exists( $thumbnailPath)) {
    //             File::makeDirectory( $thumbnailPath,0777,true,true);
    //         }

    //         $originalImage=  $image;
    //         $thumbnailImage = \Image::make($originalImage);
    //         $thumbnailImage->resize(250, 250, function ($constraint) {
    //             $constraint->aspectRatio();
    //         });
    //         $watermark= \Image::make(storage_path('app/public/backend/posts/thumbnail/watermark.jpg'));
    //          $watermark->resize(25, 25, function ($constraint) {
    //             $constraint->aspectRatio();
    //         });
    //         $thumbnailImage->insert($watermark, 'center');

    //         // $thumbnailImage->text(' All Rights Reserved', 120, 100, function($font) { 
    //         //     $font->size(35);  
    //         //     $font->color('#ff4500');  
    //         //     $font->align('center');  
    //         //     $font->valign('bottom');  
    //         //     $font->angle(90);  
    //         // }); for Text WaterMark
    //         // $thumbnailImage->resizeCanvas( $height, null, 'center', false, 'ff4500'); //For Canvas
                       
    //         $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 
    //         $postImage= new PostImage();
    //         $postImage->post_id =  $id;
    //         $postImage->image_name = time().$originalImage->getClientOriginalName();
    //         $postImage->save();
    //     }
}
