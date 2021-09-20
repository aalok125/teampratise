<?php

namespace App\Http\Controllers;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;



class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        
        return view ('backend.posts.index',compact('posts'));
    }

    public function create(){
        return view('backend.posts.create');
    }

    public function store( PostStoreRequest $request){
        $post= new Post();
        $post->post_title =  $request->get('post_title');
        $post->post_slug = Str::slug($request->get('post_title'));
        $post->post_status = $request->get('status');
        $post->is_published = $request->get('is_published');
        $post->post_content = $request->get('post_content');
        $post->user_id =1;
        $post->save();
        Session::flash('success','Post Updated successfully');
        return redirect()->route('posts.index');

    }
   
    public function edit(Post $post){
        return view ('backend.posts.edit',compact ('post'));
    }

    public function update(PostUpdateRequest $request, Post $post){
        $post->post_title =  $request->get('post_title');
        $post->post_slug = str_slug ($request->get('post_title'));
        $post->post_status = $request->get('status');
        $post->is_published = $request->get('is_published');
        $post->post_content = $request->get('post_content');
        $post->user_id = 1;
        $post->save();
        Session::flash('success','Post Updated successfully');
        return redirect()->route('posts.index');
    }
     

   public function destroy(Post $post){
        $post->delete();
        Session::flash('delete.msg','Post Deleted. Moved To Trash');
        return redirect()->route('posts.index');
    }

    public function undoDelete($id){
        Post::withTrashed()
            ->where('id',$id)
            ->restore(); 
        Session::flash('success','Post Retrived. Moved To Index Page');
        return redirect()->route('posts.trash');
    }

    public function trashPost(){
        $trashPosts = Post::onlyTrashed()->get();
        
        return view('backend.posts.trash',compact('trashPosts'));
    }
}
