<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Session;


class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(10);
        return view ('backend.post.index',compact('posts'));
    }

    public function create(){
        return view('backend.post.create');
    }   

     public function store( PostStoreRequest $request){
        $post= new Post();
        $post->post_title =  $request->get('post_title');
        $post->post_slug = str_slug ($request->get('post_title'));
        $post->post_status = $request->get('status');
        $post->is_punlished = $request->get('is_published');
        $post->post_content = $request->get('post_content');
        $post->user_id = Auth()->id();

        $post->save();
        Session::flash ('success','Post Has Been Created Successfully.');
        return redirect()->route('posts.index');
            
    }

    public function edit(Post $post){

        return view ('backend.post.edit',compact ('post'));
    }

    public function update(PostUpdateRequest $request, Post $post){
        
        $post->post_title =  $request->get('post_title');
        $post->post_slug = str_slug ($request->get('post_title'));
        $post->post_status = $request->get('status');
        $post->is_punlished = $request->get('is_published');
        $post->post_content = $request->get('post_content');
        $post->user_id = Auth()->id();
        $post->save();
        
        Session::flash('success','Post Updated successfully');
        return redirect()->route('posts.index');
    }

   public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('delete','Post Deleted Successfully');
        return redirect()->route('posts.index');
    }
}
